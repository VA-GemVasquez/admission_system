<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU - View Application</title>
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
        .status-badge {
            @apply px-4 py-2 rounded-full text-sm font-semibold;
        }
        .status-pending {
            @apply bg-yellow-100 text-yellow-800 border border-yellow-200;
        }
        .status-approved {
            @apply bg-green-100 text-green-800 border border-green-200;
        }
        .status-rejected {
            @apply bg-red-100 text-red-800 border border-red-200;
        }
        .status-waitlisted {
            @apply bg-blue-100 text-blue-800 border border-blue-200;
        }
        .info-card {
            @apply bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-md transition;
        }
        .info-label {
            @apply text-sm font-medium text-gray-500 mb-1;
        }
        .info-value {
            @apply text-base font-semibold text-gray-800;
        }
        .action-btn {
            @apply px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105 flex items-center;
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
            <!-- Header with Navigation -->
            <div class="mb-8 flex justify-between items-start">
                <div>
                    <div class="flex items-center mb-2">
                        <a href="{{ route('admin.applications') }}" class="text-gray-500 hover:text-blue-900 transition mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-blue-900">Application Details</h1>
                    </div>
                    <p class="text-gray-600 ml-9">Viewing application #{{ str_pad($application->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.edit', $application->id) }}" 
                       class="bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Application
                    </a>
                </div>
            </div>
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Main Content Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-yellow-400">
                <!-- Status Header with Gold Background -->
                <div class="psu-gold-bg px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-900 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-sm text-blue-900 font-medium">Current Status</span>
                                <div class="flex items-center mt-1">
                                    <span class="status-badge 
                                        @if($application->status == 'Pending') status-pending
                                        @elseif($application->status == 'Approved') status-approved
                                        @elseif($application->status == 'Rejected') status-rejected
                                        @else status-waitlisted
                                        @endif">
                                        {{ $application->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status Action Buttons -->
                        <div class="flex space-x-3">
                            <form action="{{ route('admin.approve', $application->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition transform hover:scale-105 flex items-center text-sm font-semibold shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.waitlist', $application->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 flex items-center text-sm font-semibold shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Waitlist
                                </button>
                            </form>
                            <form action="{{ route('admin.reject', $application->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-5 py-2.5 rounded-lg hover:bg-red-700 transition transform hover:scale-105 flex items-center text-sm font-semibold shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Applicant Summary Card -->
                <div class="p-8 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-yellow-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-20 h-20 bg-blue-900 rounded-full flex items-center justify-center">
                                <span class="text-3xl font-bold text-yellow-400">
                                    {{ substr($application->firstname, 0, 1) }}{{ substr($application->lastname, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-blue-900">{{ $application->firstname }} {{ $application->middlename }} {{ $application->lastname }}</h2>
                                <p class="text-gray-600 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $application->gmail_account }}@gmail.com
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Application ID</p>
                            <p class="text-2xl font-mono font-bold text-blue-900">#{{ str_pad($application->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Details Grid -->
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div>
                            <!-- Personal Information -->
                            <div class="info-card mb-6">
                                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    Personal Information
                                </h3>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="info-label">First Name</p>
                                            <p class="info-value">{{ $application->firstname }}</p>
                                        </div>
                                        <div>
                                            <p class="info-label">Middle Name</p>
                                            <p class="info-value">{{ $application->middlename ?: 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="info-label">Last Name</p>
                                            <p class="info-value">{{ $application->lastname }}</p>
                                        </div>
                                        <div>
                                            <p class="info-label">Years Old</p>
                                            <p class="info-value">{{ $application->years_old }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="info-label">Contact Number</p>
                                        <p class="info-value">{{ $application->contact_number }}</p>
                                    </div>
                                    <div>
                                        <p class="info-label">Temporary Address</p>
                                        <p class="info-value">{{ $application->temporary_address }}</p>
                                    </div>
                                    <div>
                                        <p class="info-label">Permanent Address</p>
                                        <p class="info-value">{{ $application->permanent_address }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Guardian Information -->
                            <div class="info-card">
                                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                    </svg>
                                    Guardian Information
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="info-label">Guardian Name</p>
                                        <p class="info-value">{{ $application->guardian_name }}</p>
                                    </div>
                                    <div>
                                        <p class="info-label">Guardian Phone</p>
                                        <p class="info-value">{{ $application->guardian_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <!-- Academic Information -->
                            <div class="info-card mb-6">
                                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                    Academic Information
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="info-label">Student Type</p>
                                        <p class="info-value">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                                {{ $application->student_type }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="info-label">Preferred Campus</p>
                                        <p class="info-value">{{ $application->campus }} Campus</p>
                                    </div>
                                    <div>
                                        <p class="info-label">College</p>
                                        <p class="info-value">{{ $application->college }}</p>
                                    </div>
                                    <div>
                                        <p class="info-label">Course</p>
                                        <p class="info-value text-lg font-bold text-blue-900">{{ $application->course }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Application Timeline -->
                            <div class="info-card">
                                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    Application Timeline
                                </h3>
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Submitted</p>
                                            <p class="text-sm text-gray-500">{{ $application->created_at->format('F d, Y') }} at {{ $application->created_at->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Last Updated</p>
                                            <p class="text-sm text-gray-500">{{ $application->updated_at->format('F d, Y') }} at {{ $application->updated_at->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('admin.applications') }}" 
                           class="text-gray-500 hover:text-blue-900 transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Applications List
                        </a>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.edit', $application->id) }}" 
                               class="bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Application
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Print Button -->
            <div class="mt-6 flex justify-end">
                <button onclick="window.print()" 
                        class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Application
                </button>
            </div>
        </div>
    </div>
</body>
</html>