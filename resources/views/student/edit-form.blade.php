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
        .form-section {
            @apply bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-md transition;
        }
        .form-section-title {
            @apply text-lg font-bold text-blue-900 mb-4 flex items-center;
        }
        .input-field {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition;
        }
        .status-badge {
            @apply px-4 py-2 rounded-full text-sm font-semibold;
        }
        .status-pending {
            @apply bg-yellow-100 text-yellow-800;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header with PSU Branding -->
    <div class="psu-blue-bg shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                        <span class="text-2xl font-bold text-blue-900">PSU</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Partido State University</h1>
                        <p class="text-yellow-300 text-sm">Edit Your Application</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="status-badge status-pending">
                        🟡 {{ $application->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- Navigation Breadcrumb -->
            <div class="mb-6 flex items-center text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-900 transition">Home</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('student.review', $application->id) }}" class="text-gray-500 hover:text-blue-900 transition">Review Application</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-900 font-semibold">Edit Application</span>
            </div>

            <!-- Warning Alert for Pending Status -->
            @if($application->status != 'Pending')
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex items-center">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <strong class="font-bold">Cannot Edit!</strong>
                    <span class="block sm:inline"> This application has been {{ $application->status }} and can no longer be edited.</span>
                </div>
            </div>
            @endif
            
            <!-- Main Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-yellow-400">
                <!-- Form Header -->
                <div class="psu-blue-bg px-8 py-4">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Application Form
                    </h2>
                    <p class="text-yellow-300 text-sm ml-8">Update your information below. All fields marked with * are required.</p>
                </div>
                
                <div class="p-8">
                    <form action="{{ route('student.update', $application->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
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
                        
                        <!-- Personal Information Section -->
                        <div class="form-section mb-8">
                            <h3 class="form-section-title">
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
                                           class="input-field">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="middlename" value="{{ old('middlename', $application->middlename) }}"
                                           class="input-field">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="lastname" value="{{ old('lastname', $application->lastname) }}" required
                                           class="input-field">
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-3 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Years Old <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="years_old" value="{{ old('years_old', $application->years_old) }}" required min="15" max="100"
                                           class="input-field">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Contact Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="contact_number" value="{{ old('contact_number', $application->contact_number) }}" required
                                           placeholder="09XXXXXXXXX"
                                           class="input-field">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Gmail Account <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex">
                                        <input type="text" name="gmail_account" value="{{ old('gmail_account', str_replace('@gmail.com', '', $application->gmail_account)) }}" required
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <span class="inline-flex items-center px-4 bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">
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
                                          class="input-field">{{ old('temporary_address', $application->temporary_address) }}</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Permanent Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="permanent_address" rows="2" required
                                          class="input-field">{{ old('permanent_address', $application->permanent_address) }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Guardian Information Section -->
                        <div class="form-section mb-8">
                            <h3 class="form-section-title">
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
                                           class="input-field">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Guardian Contact Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="guardian_phone" value="{{ old('guardian_phone', $application->guardian_phone) }}" required
                                           placeholder="09XXXXXXXXX"
                                           class="input-field">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Academic Information Section -->
                        <div class="form-section mb-8">
                            <h3 class="form-section-title">
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
                                    <select name="student_type" required id="student_type" class="input-field">
                                        <option value="Regular" {{ old('student_type', $application->student_type) == 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Irregular" {{ old('student_type', $application->student_type) == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                        <option value="Transferee" {{ old('student_type', $application->student_type) == 'Transferee' ? 'selected' : '' }}>Transferee</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Preferred Campus <span class="text-red-500">*</span>
                                    </label>
                                    <select name="campus" required id="campus" class="input-field">
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
                                    <select name="college" required id="college" class="input-field">
                                        <option value="">Select College</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Course <span class="text-red-500">*</span>
                                    </label>
                                    <select name="course" required id="course" class="input-field">
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer with Actions -->
                        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                <span class="text-red-500">*</span> Required fields
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('student.review', $application->id) }}" 
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
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-900 p-4 rounded-r-lg">
                <div class="flex">
                    <svg class="w-6 h-6 text-blue-900 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-1">Need Help?</h4>
                        <p class="text-sm text-gray-600">
                            If you need assistance with your application, please contact the Office of Admissions at 
                            <span class="font-semibold">admissions@psu.edu.ph</span> or call <span class="font-semibold">(054) 123-4567</span>.
                        </p>
                    </div>
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

        function populateColleges() {
            const campus = campusSelect.value;
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
        }

        function populateCourses() {
            const campus = campusSelect.value;
            const college = collegeSelect.value;
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
        }

        campusSelect.addEventListener('change', populateColleges);
        collegeSelect.addEventListener('change', populateCourses);

        // Trigger initial load
        window.addEventListener('load', function() {
            populateColleges();
        });

        // Disable form if not pending
        @if($application->status != 'Pending')
        document.querySelectorAll('input, select, textarea, button[type="submit"]').forEach(el => {
            el.disabled = true;
        });
        @endif
    </script>
</body>
</html>