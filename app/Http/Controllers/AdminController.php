<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        $totalApplicants = StudentApplication::count();
        $regularStudents = StudentApplication::where('student_type', 'Regular')->count();
        $irregularStudents = StudentApplication::where('student_type', 'Irregular')->count();
        $transferees = StudentApplication::where('student_type', 'Transferee')->count();
        
        $campusCounts = [
            'Goa' => StudentApplication::where('campus', 'Goa')->count(),
            'San Jose' => StudentApplication::where('campus', 'San Jose')->count(),
            'Lagonoy' => StudentApplication::where('campus', 'Lagonoy')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalApplicants', 
            'regularStudents', 
            'irregularStudents', 
            'transferees',
            'campusCounts'
        ));
    }

    public function applications(Request $request)
    {
        $query = StudentApplication::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('firstname', 'LIKE', "%{$search}%")
                  ->orWhere('middlename', 'LIKE', "%{$search}%")
                  ->orWhere('lastname', 'LIKE', "%{$search}%")
                  ->orWhere('course', 'LIKE', "%{$search}%")
                  ->orWhere('campus', 'LIKE', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('campus')) {
            $query->where('campus', $request->campus);
        }
        if ($request->filled('course')) {
            $query->where('course', $request->course);
        }
        if ($request->filled('student_type')) {
            $query->where('student_type', $request->student_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.applications', compact('applications'));
    }

    public function viewApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        return view('admin.view', compact('application'));
    }

    public function approveApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        $application->update(['status' => 'Approved']);
        return redirect()->back()->with('success', 'Application approved successfully!');
    }

    public function rejectApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        $application->update(['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Application rejected successfully!');
    }

    public function waitlistApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        $application->update(['status' => 'Waitlisted']);
        return redirect()->back()->with('success', 'Application waitlisted successfully!');
    }

    public function editApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        return view('admin.edit-application', compact('application'));
    }

    public function updateApplication(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'years_old' => 'required|integer|min:15|max:100',
            'contact_number' => 'required|string|max:20',
            'temporary_address' => 'required|string',
            'permanent_address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'student_type' => 'required|in:Regular,Irregular,Transferee',
            'campus' => 'required|in:Goa,San Jose,Lagonoy',
            'college' => 'required|string',
            'course' => 'required|string',
            'status' => 'required|in:Pending,Approved,Rejected,Waitlisted',
        ]);

        $application->update($request->all());

        return redirect()->route('admin.applications')->with('success', 'Application updated successfully!');
    }

    public function deleteApplication($id)
    {
        $application = StudentApplication::findOrFail($id);
        $application->delete();
        return redirect()->back()->with('success', 'Application deleted successfully!');
    }
}