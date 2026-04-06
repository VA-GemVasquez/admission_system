<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU - Edit Application</title>
    @vite(['resources/css/app.css'], ['resources/js/app.js'])
    <style>
        .psu-blue-bg {
            background: linear-gradient(135deg, #003366 0%, #004080 100%);
        }
        .psu-gold-bg {
            background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
        }
        .psu-gold-text {
            color: #FFD700;
        }
        .psu-blue-text {
            color: #003366;
        }
        .sidebar-active {
            background: linear-gradient(90deg, #FFD700 0%, #FDB931 100%);
            color: #003366;
            font-weight: bold;
        }
        .form-section {
            transition: all 0.3s ease;
        }
        .form-section:hover {
            border-color: #FFD700;
        }
        .input-focus:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid #FBBF24;
        }
        .status-approved {
            background-color: #D1FAE5;
            color: #065F46;
            border: 1px solid #10B981;
        }
        .status-rejected {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #EF4444;
        }
        .status-waitlisted {
            background-color: #DBEAFE;
            color: #1E40AF;
            border: 1px solid #3B82F6;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar - PSU Blue -->
        <div class="w-64 psu-blue-bg text-white shadow-2xl">
            <!-- Logo -->
            <div class="p-6 border-b border-blue-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                        <span class="text-xl font-bold text-blue-900">PSU</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Admin Panel</h2>
                        <p class="text-yellow-300 text-xs">Partido State University</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.applications') }}" class="block px-6 py-3 hover:bg-blue-700 hover:bg-opacity-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Applications
                </a>
                
                <!-- Logout at bottom -->
                <div class="absolute bottom-0 w-64 p-6">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-6 py-3 bg-blue-700 bg-opacity-50 rounded-lg hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto">
            <!-- Header with Application Info -->
            <div class="mb-8 flex justify-between items-start">
                <div>
                    <div class="flex items-center mb-2">
                        <a href="{{ route('admin.view', $application->id) }}" class="text-gray-500 hover:text-blue-900 transition mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-blue-900">Edit Application</h1>
                    </div>
                    <p class="text-gray-600 ml-9">Update information for application #{{ $application->id }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Status Badge -->
                    <div class="status-badge 
                        @if($application->status == 'Pending') status-pending
                        @elseif($application->status == 'Approved') status-approved
                        @elseif($application->status == 'Rejected') status-rejected
                        @else status-waitlisted
                        @endif">
                        <span>Current: {{ $application->status }}</span>
                    </div>
                    <a href="{{ route('admin.view', $application->id) }}" 
                       class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </div>
            
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc list-inside ml-6 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-yellow-400">
                <!-- Form Header -->
                <div class="psu-blue-bg px-8 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Application Form
                    </h2>
                </div>
                
                <div class="p-8">
                    <form action="{{ route('admin.update', $application->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Personal Information -->
                        <div class="form-section mb-8 p-6 border border-gray-200 rounded-xl hover:shadow-md">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                Personal Information
                            </h3>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="firstname" value="{{ old('firstname', $application->firstname) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="middlename" value="{{ old('middlename', $application->middlename) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="lastname" value="{{ old('lastname', $application->lastname) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-3 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Years Old <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="years_old" value="{{ old('years_old', $application->years_old) }}" required min="15" max="100"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Contact Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="contact_number" value="{{ old('contact_number', $application->contact_number) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Gmail Account <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex">
                                        <input type="text" name="gmail_account" value="{{ old('gmail_account', str_replace('@gmail.com', '', $application->gmail_account)) }}" required
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <span class="inline-flex items-center px-3 bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">
                                            @gmail.com
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Temporary Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="temporary_address" rows="2" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">{{ old('temporary_address', $application->temporary_address) }}</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Permanent Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="permanent_address" rows="2" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">{{ old('permanent_address', $application->permanent_address) }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Guardian Information -->
                        <div class="form-section mb-8 p-6 border border-gray-200 rounded-xl hover:shadow-md">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                                Guardian Information
                            </h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Guardian Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="guardian_name" value="{{ old('guardian_name', $application->guardian_name) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Guardian Contact Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="guardian_phone" value="{{ old('guardian_phone', $application->guardian_phone) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Academic Information -->
                        <div class="form-section mb-8 p-6 border border-gray-200 rounded-xl hover:shadow-md">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                Academic Information
                            </h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Student Type <span class="text-red-500">*</span>
                                    </label>
                                    <select name="student_type" required id="student_type"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="Regular" {{ old('student_type', $application->student_type) == 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Irregular" {{ old('student_type', $application->student_type) == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                        <option value="Transferee" {{ old('student_type', $application->student_type) == 'Transferee' ? 'selected' : '' }}>Transferee</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Campus <span class="text-red-500">*</span>
                                    </label>
                                    <select name="campus" required id="campus"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="Goa" {{ old('campus', $application->campus) == 'Goa' ? 'selected' : '' }}>Goa Campus</option>
                                        <option value="San Jose" {{ old('campus', $application->campus) == 'San Jose' ? 'selected' : '' }}>San Jose Campus</option>
                                        <option value="Lagonoy" {{ old('campus', $application->campus) == 'Lagonoy' ? 'selected' : '' }}>Lagonoy Campus</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        College <span class="text-red-500">*</span>
                                    </label>
                                    <select name="college" required id="college"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="">Select College</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Course <span class="text-red-500">*</span>
                                    </label>
                                    <select name="course" required id="course"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status Update Section -->
                        <div class="form-section mb-8 p-6 border border-gray-200 rounded-xl hover:shadow-md">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                Application Status
                            </h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="Pending" {{ old('status', $application->status) == 'Pending' ? 'selected' : '' }}>🟡 Pending</option>
                                        <option value="Approved" {{ old('status', $application->status) == 'Approved' ? 'selected' : '' }}>✅ Approved</option>
                                        <option value="Rejected" {{ old('status', $application->status) == 'Rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                        <option value="Waitlisted" {{ old('status', $application->status) == 'Waitlisted' ? 'selected' : '' }}>⏳ Waitlisted</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Updated
                                    </label>
                                    <input type="text" value="{{ $application->updated_at->format('F d, Y h:i A') }}" 
                                           class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.view', $application->id) }}" 
                               class="px-8 py-3 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-8 py-3 psu-blue-bg text-white rounded-lg font-semibold hover:bg-blue-800 transition transform hover:scale-105 shadow-lg flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Update Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Warning Message -->
            <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-yellow-700">
                        <span class="font-bold">Note:</span> Changing the application status will notify the student via email. Please ensure all information is correct before updating.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const campusData = {
            'Goa': {
                'COED': ['BS Science', 'BS English', 'BS Physical Education'],
                'CEC': ['BS Information Technology', 'BS Computer Science', 'BS Civil Engineering', 'BS Electrical Engineering', 'BS Sanitary Engineering']
            },
            'San Jose': {
                'Hospitality Management': ['BS Hospitality Management', 'BS Tourism']
            },
            'Lagonoy': {
                'Criminology': ['BS Criminology'],
                'Nutrition and Dietetics': ['BS Nutrition and Dietetics']
            }
        };

        const campusSelect = document.getElementById('campus');
        const collegeSelect = document.getElementById('college');
        const courseSelect = document.getElementById('course');
        const oldCollege = '{{ $application->college }}';
        const oldCourse = '{{ $application->course }}';

        campusSelect.addEventListener('change', function() {
            const campus = this.value;
            collegeSelect.innerHTML = '<option value="">Select College</option>';
            courseSelect.innerHTML = '<option value="">Select Course</option>';
            
            if (campus && campusData[campus]) {
                Object.keys(campusData[campus]).forEach(college => {
                    const option = document.createElement('option');
                    option.value = college;
                    option.textContent = college;
                    if (college === oldCollege) {
                        option.selected = true;
                    }
                    collegeSelect.appendChild(option);
                });
                
                if (oldCollege) {
                    setTimeout(() => {
                        const event = new Event('change');
                        collegeSelect.dispatchEvent(event);
                    }, 100);
                }
            }
        });

        collegeSelect.addEventListener('change', function() {
            const campus = campusSelect.value;
            const college = this.value;
            courseSelect.innerHTML = '<option value="">Select Course</option>';
            
            if (campus && college && campusData[campus] && campusData[campus][college]) {
                campusData[campus][college].forEach(course => {
                    const option = document.createElement('option');
                    option.value = course;
                    option.textContent = course;
                    if (course === oldCourse) {
                        option.selected = true;
                    }
                    courseSelect.appendChild(option);
                });
            }
        });

        // Trigger initial load
        window.addEventListener('load', function() {
            const event = new Event('change');
            campusSelect.dispatchEvent(event);
        });
    </script>
</body>
</html>