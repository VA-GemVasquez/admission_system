<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function showForm()
    {
        return view('student.admission-form');
    }

    public function submitApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'years_old' => 'required|integer|min:15|max:100',
            'contact_number' => 'required|string|max:20',
            'gmail_account' => 'required|email|unique:student_applications,gmail_account',
            'temporary_address' => 'required|string',
            'permanent_address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'student_type' => 'required|in:Regular,Irregular,Transferee',
            'campus' => 'required|in:Goa,San Jose,Lagonoy',
            'college' => 'required|string',
            'course' => 'required|string',
            'terms' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $application = StudentApplication::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'years_old' => $request->years_old,
            'contact_number' => $request->contact_number,
            'gmail_account' => $request->gmail_account,
            'temporary_address' => $request->temporary_address,
            'permanent_address' => $request->permanent_address,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'student_type' => $request->student_type,
            'campus' => $request->campus,
            'college' => $request->college,
            'course' => $request->course,
            'status' => 'Pending'
        ]);

        return redirect()->route('student.review', $application->id)
            ->with('success', 'Application submitted successfully! Please review your application.');
    }

    public function reviewApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        return view('student.review', compact('application'));
    }

    public function editApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        
        // Only allow editing if status is pending
        if ($application->status !== 'Pending') {
            return redirect()->route('student.status', $id)
                ->with('error', 'Cannot edit application that is already ' . $application->status);
        }
        
        return view('student.edit-form', compact('application'));
    }

    public function updateApplication(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);
        
        if ($application->status !== 'Pending') {
            return redirect()->route('student.status', $id)
                ->with('error', 'Cannot edit application that is already ' . $application->status);
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'years_old' => 'required|integer|min:15|max:100',
            'contact_number' => 'required|string|max:20',
            'gmail_account' => 'required|email|unique:student_applications,gmail_account,' . $id,
            'temporary_address' => 'required|string',
            'permanent_address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'student_type' => 'required|in:Regular,Irregular,Transferee',
            'campus' => 'required|in:Goa,San Jose,Lagonoy',
            'college' => 'required|string',
            'course' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $application->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'years_old' => $request->years_old,
            'contact_number' => $request->contact_number,
            'gmail_account' => $request->gmail_account,
            'temporary_address' => $request->temporary_address,
            'permanent_address' => $request->permanent_address,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'student_type' => $request->student_type,
            'campus' => $request->campus,
            'college' => $request->college,
            'course' => $request->course,
        ]);

        return redirect()->route('student.review', $id)
            ->with('success', 'Application updated successfully!');
    }

    public function checkStatus($id)
    {
        $application = StudentApplication::findOrFail($id);
        return view('student.status', compact('application'));
    }

    public function showTrackPage()
    {
        return view('student.track');
    }

    public function lookupApplication(Request $request)
{
    $validator = Validator::make($request->all(), [
        'application_id' => 'nullable|string', // Changed from integer to string
        'email' => 'nullable|string'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Check if neither field is provided
    if (!$request->filled('application_id') && !$request->filled('email')) {
        return redirect()->back()
            ->with('error', 'Please enter either an Application ID or Gmail address.')
            ->withInput();
    }

    // Search by Application ID
    if ($request->filled('application_id')) {
        // Remove leading zeros and convert to integer for lookup
        $appId = ltrim($request->application_id, '0');
        
        // If after removing zeros it's empty, it means the ID was all zeros
        if ($appId === '') {
            return redirect()->back()
                ->with('error', 'Invalid Application ID format.')
                ->withInput();
        }
        
        $application = StudentApplication::find($appId);
        
        if ($application) {
            return redirect()->route('student.status', $application->id)
                ->with('success', 'Application found!');
        } else {
            return redirect()->back()
                ->with('error', 'No application found with ID: ' . $request->application_id)
                ->withInput();
        }
    }

    // Search by Gmail
    if ($request->filled('email')) {
        // Clean the email
        $email = trim($request->email);
        $email = str_replace(['@gmail.com', '@'], '', $email);
        
        $application = StudentApplication::where('gmail_account', $email)->first();
        
        if ($application) {
            return redirect()->route('student.status', $application->id)
                ->with('success', 'Application found!');
        } else {
            return redirect()->back()
                ->with('error', 'No application found with Gmail: ' . $request->email)
                ->withInput();
        }
    }
}
}