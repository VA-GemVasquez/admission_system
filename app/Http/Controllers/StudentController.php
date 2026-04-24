<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationSubmitted;

class StudentController extends Controller
{
    public function showForm()
    {
        $campuses = Campus::with('colleges.courses')->get();
        return view('student.admission-form', compact('campuses'));
    }

    public function submitApplication(Request $request)
    {
        $validator = Validator::make($request->all(), array_merge(
            $this->applicationRules(),
            [
                'terms' => 'required|accepted',
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'birth_certificate' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
                'report_card' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
            ]
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photoPath = $request->file('photo')->store('documents/photos', 'public');
        $birthCertPath = $request->file('birth_certificate')->store('documents/birth_certificates', 'public');
        $reportCardPath = $request->file('report_card')->store('documents/report_cards', 'public');

        $application = StudentApplication::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name_extender' => $request->name_extender,
            'age' => $request->age,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'date_of_birth' => $request->date_of_birth,
            'birth_place' => $request->birth_place,
            'contact_number' => $request->contact_number,
            'gmail_account' => $request->gmail_account,
            'temporary_address' => $request->temporary_address,
            'permanent_address' => $request->permanent_address,
            'guardian_name' => $request->guardian_name,
            'guardian_relationship' => $request->guardian_relationship,
            'guardian_phone' => $request->guardian_phone,
            'campus' => $request->campus,
            'college' => $request->college,
            'course' => $request->course,
            'photo_path' => $photoPath,
            'birth_certificate_path' => $birthCertPath,
            'report_card_path' => $reportCardPath,
            'status' => 'Pending',
        ]);

        $this->grantOwnership($request, $application->id);

        try {
            Mail::to($application->gmail_account)->send(new ApplicationSubmitted($application));
        } catch (\Exception $e) {
            \Log::error('Mail failed: ' . $e->getMessage());
        }

        return redirect()->route('student.review', $application->id)
            ->with('success', 'Application submitted successfully! A confirmation email has been sent to your Gmail.');
    }

    public function reviewApplication(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);
        $this->authorizeOwnership($request, (int) $id);
        return view('student.review', compact('application'));
    }

    public function editApplication(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);
        $this->authorizeOwnership($request, (int) $id);

        if ($application->status !== 'Pending') {
            return redirect()->route('student.status', $id)
                ->with('error', 'Cannot edit application that is already ' . $application->status);
        }

        $campuses = Campus::with('colleges.courses')->get();
        return view('student.edit-form', compact('application', 'campuses'));
    }

    public function updateApplication(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);
        $this->authorizeOwnership($request, (int) $id);

        if ($application->status !== 'Pending') {
            return redirect()->route('student.status', $id)
                ->with('error', 'Cannot edit application that is already ' . $application->status);
        }

        $validator = Validator::make($request->all(), $this->applicationRules((int) $id));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $application->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name_extender' => $request->name_extender,
            'age' => $request->age,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'date_of_birth' => $request->date_of_birth,
            'birth_place' => $request->birth_place,
            'contact_number' => $request->contact_number,
            'gmail_account' => $request->gmail_account,
            'temporary_address' => $request->temporary_address,
            'permanent_address' => $request->permanent_address,
            'guardian_name' => $request->guardian_name,
            'guardian_relationship' => $request->guardian_relationship,
            'guardian_phone' => $request->guardian_phone,
            'campus' => $request->campus,
            'college' => $request->college,
            'course' => $request->course,
        ]);

        return redirect()->route('student.review', $id)
            ->with('success', 'Application updated successfully!');
    }

    public function checkStatus(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);
        $this->authorizeOwnership($request, (int) $id);
        return view('student.status', compact('application'));
    }

    public function showTrackPage()
    {
        return view('student.track');
    }

    public function lookupApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $appId = ltrim($request->application_id, '0');

        if ($appId === '') {
            return redirect()->back()
                ->with('error', 'Invalid Application ID format.')
                ->withInput();
        }

        $application = StudentApplication::find($appId);

        if ($application) {
            $this->grantOwnership($request, $application->id);
            return redirect()->route('student.status', $application->id)
                ->with('success', 'Application found!');
        }

        return redirect()->back()
            ->with('error', 'No application found. Please check your Application ID and try again.')
            ->withInput();
    }

    private function applicationRules(int $excludeId = null): array
    {
        $emailRule = 'required|email|unique:student_applications,gmail_account'
            . ($excludeId ? ',' . $excludeId : '');

        return [
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'name_extender' => 'nullable|string|max:10',
            'age' => 'required|integer|min:15|max:100',
            'sex' => 'required|in:Male,Female',
            'civil_status' => 'required|in:Single,Married,Widowed,Divorced,Separated',
            'date_of_birth' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'contact_number' => ['required', 'regex:/^[0-9\+\-\s\(\)]{7,20}$/'],
            'gmail_account' => $emailRule,
            'temporary_address' => 'required|string',
            'permanent_address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_relationship' => 'required|in:Mother,Father,Brother,Sister,Grandmother,Grandfather,Auntie,Uncle,Legal Guardian',
            'guardian_phone' => ['required', 'regex:/^[0-9\+\-\s\(\)]{7,20}$/'],
            'campus' => 'required|string',
            'college' => 'required|string',
            'course' => 'required|string',
        ];
    }

    private function grantOwnership(Request $request, int $id): void
    {
        $owned = $request->session()->get('owned_applications', []);
        if (!in_array($id, $owned)) {
            $owned[] = $id;
            $request->session()->put('owned_applications', $owned);
        }
    }

    private function authorizeOwnership(Request $request, int $id): void
    {
        $owned = array_map('intval', $request->session()->get('owned_applications', []));
        if (!in_array($id, $owned)) {
            abort(403, 'You are not authorized to access this application.');
        }
    }
}
