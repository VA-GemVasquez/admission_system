<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU - Admin Dashboard</title>
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
        .stat-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 51, 102, 0.2), 0 10px 10px -5px rgba(255, 215, 0, 0.1);
        }
        .progress-bar {
            background: linear-gradient(90deg, #FFD700 0%, #FDB931 100%);
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
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 sidebar-active flex items-center">
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
        <div class="flex-1 p-8">
            <!-- Header with Welcome and Date -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-blue-900">Dashboard</h1>
                    <p class="text-gray-600">Welcome back, Administrator</p>
                </div>
                <div class="bg-white px-6 py-3 rounded-lg shadow-md flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-700">{{ now()->format('F d, Y') }}</span>
                </div>
            </div>
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Applicants -->
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Applicants</p>
                            <p class="text-3xl font-bold text-blue-900 mt-2">{{ $totalApplicants }}</p>
                            <p class="text-xs text-green-600 mt-2">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    +12% from last month
                                </span>
                            </p>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-full">
                            <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Regular Students -->
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Regular Students</p>
                            <p class="text-3xl font-bold text-green-700 mt-2">{{ $regularStudents }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $totalApplicants > 0 ? round(($regularStudents / $totalApplicants) * 100) : 0 }}% of total</p>
                        </div>
                        <div class="p-4 bg-green-100 rounded-full">
                            <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Irregular Students -->
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Irregular Students</p>
                            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $irregularStudents }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $totalApplicants > 0 ? round(($irregularStudents / $totalApplicants) * 100) : 0 }}% of total</p>
                        </div>
                        <div class="p-4 bg-yellow-100 rounded-full">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Transferees -->
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Transferees</p>
                            <p class="text-3xl font-bold text-purple-700 mt-2">{{ $transferees }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $totalApplicants > 0 ? round(($transferees / $totalApplicants) * 100) : 0 }}% of total</p>
                        </div>
                        <div class="p-4 bg-purple-100 rounded-full">
                            <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row - Additional Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Pending Applications Card -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Pending Applications</h3>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                            Needs Review
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-4xl font-bold text-yellow-500">
                                {{ \App\Models\StudentApplication::where('status', 'Pending')->count() }}
                            </p>
                            <p class="text-sm text-gray-500 mt-2">awaiting decision</p>
                        </div>
                        <a href="{{ route('admin.applications', ['status' => 'Pending']) }}" 
                           class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition flex items-center">
                            Review Now
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Today's Applications Card -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Today's Applications</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            New
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-4xl font-bold text-blue-900">
                                {{ \App\Models\StudentApplication::whereDate('created_at', today())->count() }}
                            </p>
                            <p class="text-sm text-gray-500 mt-2">submitted today</p>
                        </div>
                        <a href="{{ route('admin.applications') }}" 
                           class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition flex items-center">
                            View All
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Applicants per Campus with Gold Progress Bars -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-400">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-blue-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Applicants per Campus
                    </h2>
                    <span class="text-sm text-gray-500">Total: {{ $totalApplicants }} applicants</span>
                </div>
                <div class="space-y-6">
                    @foreach($campusCounts as $campus => $count)
                    <div>
                        <div class="flex justify-between mb-2">
                            <div>
                                <span class="font-semibold text-gray-700">{{ $campus }} Campus</span>
                                <span class="ml-2 text-sm text-gray-500">{{ $count }} applicants</span>
                            </div>
                            <span class="text-sm font-semibold text-blue-900">
                                {{ $totalApplicants > 0 ? round(($count / $totalApplicants) * 100) : 0 }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            @php
                                $percentage = $totalApplicants > 0 ? ($count / $totalApplicants) * 100 : 0;
                            @endphp
                            <div class="progress-bar h-3 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Quick Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-md font-semibold text-gray-700 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.applications', ['status' => 'Pending']) }}" 
                           class="flex items-center p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                            <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Review Pending</span>
                        </a>
                        <a href="{{ route('admin.applications', ['status' => 'Approved']) }}" 
                           class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">View Approved</span>
                        </a>
                        <a href="{{ route('admin.applications') }}" 
                           class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">All Applications</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>