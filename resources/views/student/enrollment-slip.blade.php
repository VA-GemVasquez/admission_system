<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Slip - {{ $application->full_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .psu-blue-bg { background: linear-gradient(135deg, #000035 0%, #00004d 100%); }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .print-container { box-shadow: none !important; border: none !important; }
            @page { margin: 1cm; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-8">

    <!-- Action Bar -->
    <div class="no-print max-w-3xl mx-auto px-4 mb-4 flex items-center justify-between">
        <a href="{{ route('student.status', $application->id) }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-[#000035] transition font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Status
        </a>
        <button onclick="window.print()"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#000035] text-yellow-400 font-bold rounded-lg hover:bg-opacity-90 transition text-sm shadow">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Print / Save PDF
        </button>
    </div>

    <!-- Slip -->
    <div class="print-container max-w-3xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200 px-0">

        <!-- Header -->
        <div class="psu-blue-bg px-8 py-6 text-center">
            <div class="flex items-center justify-center gap-4 mb-3">
                <div class="w-16 h-16 rounded-full overflow-hidden bg-yellow-400 flex items-center justify-center flex-shrink-0">
                    <img src="{{ asset('images/PSU_LOGO.png') }}" alt="PSU Logo"
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-black text-[#000035] text-xl\'>PSU</span>'">
                </div>
                <div class="text-left">
                    <h1 class="text-white font-black text-xl leading-tight">Partido State University</h1>
                    <p class="text-yellow-300 text-sm">Office of Admissions</p>
                    <p class="text-yellow-300 text-xs">Goa, Camarines Sur</p>
                </div>
            </div>
            <div class="border-t border-yellow-400/30 pt-3 mt-1">
                <h2 class="text-yellow-400 font-black text-2xl tracking-widest uppercase">Enrollment Slip</h2>
                <p class="text-yellow-200 text-xs mt-1">Academic Year 2025 – 2026</p>
            </div>
        </div>

        <!-- Control Number Banner -->
        <div class="bg-yellow-400 px-8 py-2 flex items-center justify-between">
            <span class="text-[#000035] text-xs font-bold uppercase tracking-widest">Control No.</span>
            <span class="text-[#000035] font-black text-lg tracking-widest">
                PSU-{{ now()->format('Y') }}-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}
            </span>
            <span class="text-[#000035] text-xs font-bold">{{ $application->updated_at->format('M d, Y') }}</span>
        </div>

        <div class="px-8 py-6">

            <!-- Approval Notice -->
            <div class="flex items-start gap-3 p-4 bg-green-50 border border-green-200 rounded-xl mb-6">
                <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-green-800 font-bold text-sm">Application Approved</p>
                    <p class="text-green-700 text-xs mt-0.5">
                        This serves as official confirmation that your admission application has been approved.
                        Present this slip at the campus registrar to proceed with enrollment.
                    </p>
                </div>
            </div>

            <!-- Student Information -->
            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Student Information</h3>
            <table class="w-full text-sm mb-6">
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-2.5 text-gray-500 w-40 font-medium">Full Name</td>
                        <td class="py-2.5 font-bold text-[#000035] text-base">{{ $application->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500 font-medium">Date of Birth</td>
                        <td class="py-2.5 font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($application->date_of_birth)->format('F d, Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500 font-medium">Sex</td>
                        <td class="py-2.5 font-semibold text-gray-800">{{ $application->sex }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500 font-medium">Contact Number</td>
                        <td class="py-2.5 font-semibold text-gray-800">{{ $application->contact_number }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500 font-medium">Email</td>
                        <td class="py-2.5 font-semibold text-gray-800">{{ $application->gmail_account }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500 font-medium">Address</td>
                        <td class="py-2.5 font-semibold text-gray-800">{{ $application->permanent_address }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Academic Information -->
            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Academic Information</h3>
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 text-center">
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Campus</p>
                    <p class="font-black text-[#000035]">{{ $application->campus }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 text-center">
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">College</p>
                    <p class="font-bold text-[#000035] text-sm leading-tight">{{ $application->college }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 text-center">
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Course</p>
                    <p class="font-bold text-[#000035] text-sm leading-tight">{{ $application->course }}</p>
                </div>
            </div>

            <!-- Signature Area -->
            <div class="grid grid-cols-2 gap-8 mt-8 pt-6 border-t border-dashed border-gray-300">
                <div class="text-center">
                    <div class="h-12 mb-2"></div>
                    <div class="border-t-2 border-[#000035] pt-2">
                        <p class="text-xs font-bold text-[#000035] uppercase tracking-wide">Applicant's Signature</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $application->full_name }}</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="h-12 mb-2"></div>
                    <div class="border-t-2 border-[#000035] pt-2">
                        <p class="text-xs font-bold text-[#000035] uppercase tracking-wide">Registrar / Admissions Officer</p>
                        <p class="text-xs text-gray-500 mt-0.5">Partido State University</p>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-6 p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-center">
                <p class="text-xs text-yellow-800">
                    <strong>IMPORTANT:</strong> This slip is valid only for the current academic year (2025–2026).
                    Bring this along with your original documents when reporting to the campus registrar.
                </p>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bg-gray-50 border-t border-gray-200 px-8 py-3 flex items-center justify-between text-xs text-gray-400">
            <span>Generated: {{ now()->format('F d, Y h:i A') }}</span>
            <span>PSU Online Admission System</span>
            <span>Ref: PSU-{{ now()->format('Y') }}-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

</body>
</html>
