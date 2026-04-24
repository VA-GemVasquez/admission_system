<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partido State University - Admission System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .top-bar {
            background-color: #000035;
            height: 50px;
            width: 100%;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 10px);
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            width: 300px;
        }

        .logo-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .university-name {
            font-size: 18px;
            font-weight: 800;
            color: #000035;
            text-align: center;
            margin: 0;
        }

        .university-location {
            font-size: 14px;
            font-weight: 600;
            color: #000035;
            text-align: center;
            margin: 0;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 16px;
            background-color: #000035;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            border-radius: 50px;
            transition: background-color 0.2s ease, transform 0.2s ease;
            box-sizing: border-box;
        }

        .btn:hover {
            background-color: #00006a;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="top-bar"></div>

    <div class="page-wrapper">
        <div class="card">
            <img src="{{ asset('images/PSU_LOGO.png') }}"
                 alt="PSU Logo"
                 class="logo-img"
                 onerror="this.style.display='none'">

            <p class="university-name">Partido State University</p>
            <p class="university-location">Goa, Camarines Sur</p>

            <a href="{{ route('admin.login') }}" class="btn">Administrator</a>
            <a href="{{ route('student.apply') }}" class="btn">Apply for Admission</a>
        </div>
    </div>
</body>
</html>
