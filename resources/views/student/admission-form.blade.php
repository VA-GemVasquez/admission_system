<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU - Student Admission Form</title>
    @vite(['resources/css/app.css'], ['resources/js/app.js'])
    <style>
        .psu-blue-bg {
            background: linear-gradient(135deg, #000035 0%, #00004d 100%);
        }
        .psu-gold-bg {
            background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
        }
        .psu-gold-text {
            color: #FFD700;
        }
        .psu-blue-text {
            color: #000035;
        }
        .border-gold {
            border-color: #FFD700;
        }
        .focus-ring-gold:focus {
            ring-color: #FFD700;
        }
        .track-card {
            @apply bg-gradient-to-r from-blue-50 to-yellow-50 border border-yellow-200 rounded-xl p-4 hover:shadow-md transition;
        }
        .logo-container {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header with PSU Branding -->
    <div class="psu-blue-bg shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- PSU Logo Image -->
                    <div class="logo-container">
                        <img src="{{ asset('images/PSU_LOGO.png') }}" 
                             alt="PSU Logo" 
                             onerror="this.onerror=null; this.parentElement.style.backgroundColor='#FFD700'; this.parentElement.innerHTML='<span class=\'text-2xl font-bold text-[#000035]\'>PSU</span>';">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Partido State University</h1>
                        <p class="text-yellow-300 text-sm">Admission Application Form</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-yellow-300 text-sm">Academic Year 2024-2025</p>
                    <p class="text-white text-sm">Application #: <span class="text-yellow-300 font-semibold">NEW</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- Track Your Application Banner -->
            <div class="mb-6 track-card">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#000035] rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#000035]">Already Submitted an Application?</h3>
                            <p class="text-sm text-gray-600">Track your application status and check your admission progress</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('student.track') }}" 
                           class="px-6 py-3 bg-[#000035] text-white rounded-lg font-semibold hover:bg-opacity-90 transition transform hover:scale-105 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Track Your Application
                        </a>
                        <a href="{{ route('student.lookup') }}" 
                           class="px-6 py-3 bg-yellow-500 text-[#000035] rounded-lg font-semibold hover:bg-yellow-400 transition transform hover:scale-105 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Find My Application
                        </a>
                    </div>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#000035] rounded-full flex items-center justify-center text-white font-bold">1</div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Step 1</p>
                            <p class="font-semibold text-[#000035]">Personal Info</p>
                        </div>
                    </div>
                    <div class="flex-1 mx-4 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold">2</div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Step 2</p>
                            <p class="font-semibold text-gray-500">Guardian Info</p>
                        </div>
                    </div>
                    <div class="flex-1 mx-4 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold">3</div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Step 3</p>
                            <p class="font-semibold text-gray-500">Academic Info</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Form Header -->
                <div class="psu-gold-bg px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-[#000035]">Application Form</h2>
                        <div class="bg-[#000035] text-yellow-400 px-4 py-2 rounded-lg">
                            <span class="text-sm">* Required Fields</span>
                        </div>
                    </div>
                </div>
                
                <!-- Form Body -->
                <div class="p-8">
                    <form action="{{ route('student.submit') }}" method="POST" id="admissionForm">
                        @csrf
                        
                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                                <div class="flex items-center mb-2">
                                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-semibold">Please fix the following errors:</span>
                                </div>
                                <ul class="list-disc list-inside ml-6">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Personal Information Section -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-[#000035] mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                Personal Information
                            </h3>
                            
                            <!-- Name Fields -->
                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="lastname" value="{{ old('lastname') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="firstname" value="{{ old('firstname') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="middlename" value="{{ old('middlename') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                            </div>

                            <!-- Name Extender -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name Extender</label>
                                <select name="name_extender" 
                                        class="w-full md:w-64 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                    <option value="">None</option>
                                    <option value="Jr." {{ old('name_extender') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                    <option value="Sr." {{ old('name_extender') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                    <option value="I" {{ old('name_extender') == 'I' ? 'selected' : '' }}>I</option>
                                    <option value="II" {{ old('name_extender') == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ old('name_extender') == 'III' ? 'selected' : '' }}>III</option>
                                </select>
                            </div>

                            <!-- Age, Sex and Civil Status -->
                            <div class="grid md:grid-cols-3 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Age <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="age" value="{{ old('age') }}" required min="15" max="100"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Sex <span class="text-red-500">*</span>
                                    </label>
                                    <select name="sex" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="">Select Sex</option>
                                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Civil Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="civil_status" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="">Select Civil Status</option>
                                        <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                        <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Separated" {{ old('civil_status') == 'Separated' ? 'selected' : '' }}>Separated</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Date of Birth and Birth Place -->
                            <div class="grid md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Date of Birth <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Place of Birth <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="birth_place" value="{{ old('birth_place') }}" required
                                           placeholder="City, Province"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                            </div>

                            <!-- Addresses -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Temporary Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="temporary_address" rows="2" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">{{ old('temporary_address') }}</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Permanent Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="permanent_address" rows="2" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">{{ old('permanent_address') }}</textarea>
                            </div>

                            <!-- Contact Info -->
                            <div class="grid md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Cellphone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="contact_number" value="{{ old('contact_number') }}" required
                                           placeholder="09XXXXXXXXX"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Gmail Account <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex">
                                        <input type="email" name="gmail_account" value="{{ old('gmail_account') }}" required
                                               placeholder="your.email"
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <span class="inline-flex items-center px-3 py-3 bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">
                                            @gmail.com
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">We'll send admission updates to this email</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Guardian Information Section -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-[#000035] mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                                Guardian Information
                            </h3>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Guardian Complete Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Relationship <span class="text-red-500">*</span>
                                    </label>
                                    <select name="guardian_relationship" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="">Select Relationship</option>
                                        <option value="Mother" {{ old('guardian_relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                        <option value="Father" {{ old('guardian_relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                                        <option value="Brother" {{ old('guardian_relationship') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                        <option value="Sister" {{ old('guardian_relationship') == 'Sister' ? 'selected' : '' }}>Sister</option>
                                        <option value="Grandmother" {{ old('guardian_relationship') == 'Grandmother' ? 'selected' : '' }}>Grandmother</option>
                                        <option value="Grandfather" {{ old('guardian_relationship') == 'Grandfather' ? 'selected' : '' }}>Grandfather</option>
                                        <option value="Auntie" {{ old('guardian_relationship') == 'Auntie' ? 'selected' : '' }}>Auntie</option>
                                        <option value="Uncle" {{ old('guardian_relationship') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                        <option value="Legal Guardian" {{ old('guardian_relationship') == 'Legal Guardian' ? 'selected' : '' }}>Legal Guardian</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Guardian Contact Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" required
                                           placeholder="09XXXXXXXXX"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Academic Information Section -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-[#000035] mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
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
                                        <option value="">Select Student Type</option>
                                        <option value="Regular" {{ old('student_type') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Irregular" {{ old('student_type') == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                        <option value="Transferee" {{ old('student_type') == 'Transferee' ? 'selected' : '' }}>Transferee</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Preferred Campus <span class="text-red-500">*</span>
                                    </label>
                                    <select name="campus" required id="campus"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                                        <option value="">Select Campus</option>
                                        <option value="Goa" {{ old('campus') == 'Goa' ? 'selected' : '' }}>Goa Campus</option>
                                        <option value="San Jose" {{ old('campus') == 'San Jose' ? 'selected' : '' }}>San Jose Campus</option>
                                        <option value="Lagonoy" {{ old('campus') == 'Lagonoy' ? 'selected' : '' }}>Lagonoy Campus</option>
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

                        <!-- Terms and Conditions -->
                        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                            <label class="flex items-start">
                                <input type="checkbox" name="terms" required class="mt-1 mr-3">
                                <span class="text-sm text-gray-600">
                                    I hereby certify that the information provided is true and correct to the best of my knowledge. I understand that any false information may result in the cancellation of my application. 
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="flex justify-between items-center pt-4 border-t">
                            <div class="flex space-x-3">
                                <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#000035] transition flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Back to Home
                                </a>
                                <a href="{{ route('student.track') }}" class="text-[#000035] hover:text-yellow-600 transition flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Track Application
                                </a>
                            </div>
                            <button type="submit"
                                    class="psu-blue-bg text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-opacity-90 transition transform hover:scale-105 shadow-lg flex items-center">
                                Submit Application
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Application Lookup -->
            <div class="mt-8 grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-400">
                    <h3 class="text-lg font-bold text-[#000035] mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Already Applied?
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Enter your Application ID or Gmail to check your application status</p>
                    <form action="{{ route('student.lookup') }}" method="GET" class="space-y-3">
                        <div class="flex gap-2">
                            <input type="text" name="application_id" placeholder="Application ID" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                            <span class="text-gray-500 self-center">or</span>
                            <input type="email" name="email" placeholder="Gmail" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                        </div>
                        <button type="submit" 
                                class="w-full bg-[#000035] text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Check Status
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-400">
                    <h3 class="text-lg font-bold text-[#000035] mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Need Help?
                    </h3>
                    <p class="text-sm text-gray-600 mb-3">Contact the Office of Admissions for assistance</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-600">admissions@psu.edu.ph</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-600">(054) 123-4567</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="mt-6 bg-blue-50 border-l-4 border-[#000035] p-4 rounded-r-lg">
                <div class="flex">
                    <svg class="w-6 h-6 text-[#000035] mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-[#000035] mb-1">Important Reminders:</h4>
                        <ul class="text-sm text-gray-600 list-disc list-inside space-y-1">
                            <li>All fields marked with <span class="text-red-500">*</span> are required</li>
                            <li>Make sure your Gmail account is active - we'll send admission updates there</li>
                            <li>Double-check your contact number for any admission interviews</li>
                            <li>You can edit your application until it is reviewed by the admissions office</li>
                            <li>Save your Application ID after submission to track your status</li>
                        </ul>
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

        campusSelect.addEventListener('change', function() {
            const campus = this.value;
            collegeSelect.innerHTML = '<option value="">Select College</option>';
            courseSelect.innerHTML = '<option value="">Select Course</option>';
            
            if (campus && campusData[campus]) {
                Object.keys(campusData[campus]).forEach(college => {
                    const option = document.createElement('option');
                    option.value = college;
                    option.textContent = college;
                    collegeSelect.appendChild(option);
                });
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
                    courseSelect.appendChild(option);
                });
            }
        });

        // Set initial values if editing
        const oldCampus = '{{ old('campus') }}';
        const oldCollege = '{{ old('college') }}';
        const oldCourse = '{{ old('course') }}';
        
        if (oldCampus) {
            campusSelect.value = oldCampus;
            campusSelect.dispatchEvent(new Event('change'));
            
            if (oldCollege) {
                setTimeout(() => {
                    collegeSelect.value = oldCollege;
                    collegeSelect.dispatchEvent(new Event('change'));
                    
                    setTimeout(() => {
                        courseSelect.value = oldCourse;
                    }, 100);
                }, 100);
            }
        }
    </script>
</body>
</html>