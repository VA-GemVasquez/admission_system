<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partido State University - Admission System</title>
    @vite(['resources/css/app.css'], ['resources/js/app.js'])
    <style>
        /* Fallback while loading */
        body { visibility: hidden; }
        .loaded body { visibility: visible; }
        
        /* Custom PSU colors and styles */
        .psu-blue-bg {
            background: linear-gradient(135deg, #003366 0%, #004080 100%);
        }
        .psu-gold-text {
            color: #FFD700;
        }
        .psu-gold-bg {
            background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
        }
        .psu-blue-text {
            color: #003366;
        }
        .hover-gold:hover {
            background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
            color: #003366;
            border: 2px solid #003366;
        }
        .hover-blue:hover {
            background: linear-gradient(135deg, #003366 0%, #004080 100%);
            color: #FFD700;
            border: 2px solid #FFD700;
        }
        .border-gold {
            border: 2px solid #FFD700;
        }
        .border-blue {
            border: 2px solid #003366;
        }
        .hero-pattern {
            background-color: #003366;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFD700' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Hero Section with PSU Blue -->
    <div class="psu-blue-bg hero-pattern relative overflow-hidden">
        <!-- Decorative Gold Accents -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-yellow-300 to-yellow-500 opacity-10 rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-yellow-300 to-yellow-500 opacity-10 rounded-full transform -translate-x-48 translate-y-48"></div>
        
        <!-- Navigation -->
        <nav class="relative z-10 container mx-auto px-6 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                        <span class="text-2xl font-bold text-blue-900">PSU</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">University Admission System</h2>
                        <p class="text-yellow-300 text-sm">Excellence | Service | Leadership</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-yellow-300 transition px-4 py-2">About</a>
                    <a href="#" class="text-white hover:text-yellow-300 transition px-4 py-2">Contact</a>
                    <a href="#" class="bg-yellow-400 text-blue-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        Help
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Hero Content -->
        <div class="container mx-auto px-6 py-16 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block bg-yellow-400 text-blue-900 px-6 py-2 rounded-full font-semibold mb-6">
                    🎓 Admission for AY 2025-2026 Now Open!
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Welcome to <span class="text-yellow-400">Admission </span><br>System
                </h1>
                <p class="text-xl text-blue-100 mb-8">
                    Your journey to excellence starts here. Join the Partido State University community and be part of our tradition of academic excellence.
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="#portals" class="bg-yellow-400 text-blue-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-500 transition transform hover:scale-105 shadow-lg">
                        Get Started
                    </a>
                    <a href="#" class="border-2 border-yellow-400 text-yellow-400 px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-105">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="relative z-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- Portals Section -->
    <div id="portals" class="container mx-auto px-6 py-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Choose Your Portal</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Goodluck applicants!
            </p>
        </div>

        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8">
            <!-- Admin Portal Card -->
            <div class="group bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <!-- Card Header -->
                <div class="relative h-48 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-800 to-blue-900"></div>
                    <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23FFD700' fill-opacity='0.2' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E');"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-32 h-32 bg-yellow-400 rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                            <svg class="w-16 h-16 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="p-8 text-center">
                    <h3 class="text-3xl font-bold text-blue-900 mb-3">Admin Portal</h3>
                    <p class="text-gray-600 mb-6">Comprehensive management system for administrators to handle applications, review submissions, and manage admission status.</p>
                    
                    <!-- Features List -->
                    <div class="text-left mb-8 space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Dashboard with analytics</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Manage applications</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Approve/Reject applications</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Generate reports</span>
                        </div>
                    </div>

                    <a href="{{ route('admin.login') }}" 
                       class="inline-block w-full bg-gradient-to-r from-blue-700 to-blue-900 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-blue-800 hover:to-blue-950 transition transform hover:scale-105 shadow-lg group-hover:shadow-xl">
                        Access Admin Portal
                        <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Student Portal Card -->
            <div class="group bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <!-- Card Header -->
                <div class="relative h-48 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-yellow-600"></div>
                    <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23003366' fill-opacity='0.2' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E');"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-32 h-32 bg-blue-800 rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                            <svg class="w-16 h-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="p-8 text-center">
                    <h3 class="text-3xl font-bold text-blue-900 mb-3">Student Portal</h3>
                    <p class="text-gray-600 mb-6">Apply for admission, track your application status, and manage your academic journey with ease.</p>
                    
                    <!-- Features List -->
                    <div class="text-left mb-8 space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Online application form</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Track application status</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Edit pending applications</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>View application summary</span>
                        </div>
                    </div>

                    <a href="{{ route('student.apply') }}" 
                       class="inline-block w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-900 px-8 py-4 rounded-xl font-bold text-lg hover:from-yellow-500 hover:to-yellow-600 transition transform hover:scale-105 shadow-lg group-hover:shadow-xl">
                        Start Your Application
                        <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="psu-blue-bg py-16 mt-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">5K+</div>
                    <div class="text-white text-lg">Active Students</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">50+</div>
                    <div class="text-white text-lg">Academic Programs</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">95%</div>
                    <div class="text-white text-lg">Graduate Employment</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">3</div>
                    <div class="text-white text-lg">Campuses</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-950 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                            <span class="text-xl font-bold text-blue-900">PSU</span>
                        </div>
                        <span class="text-xl font-bold">Partido State University</span>
                    </div>
                    <p class="text-blue-200">Excellence, Service, and Leadership in Education</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-yellow-400 mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li><a href="#" class="hover:text-yellow-400 transition">About Us</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition">Admission</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition">Academics</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition">Research</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-yellow-400 mb-4">Campuses</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li>Goa Campus</li>
                        <li>San Jose Campus</li>
                        <li>Lagonoy Campus</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-yellow-400 mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li>📞 (054) 123-4567</li>
                        <li>📧 admissions@psu.edu.ph</li>
                        <li>📍 Goa, Camarines Sur</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-300">
                <p>&copy; 2024 Partido State University. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.body.parentElement.classList.add('loaded');
    </script>
</body>
</html>