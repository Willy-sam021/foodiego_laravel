<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - @yield('code')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="text-center max-w-lg px-6 py-12 bg-white rounded-2xl shadow-lg">
        <h1 class="text-7xl font-extrabold text-red-600 mb-4">@yield('code')</h1>
        <h2 class="text-2xl font-semibold text-gray-800">@yield('title')</h2>
        <p class="text-gray-600 mt-3">@yield('message')</p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ url('/') }}"
               class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Go Home
            </a>
            <a href="javascript:history.back()"
               class="px-5 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                Go Back
            </a>
        </div>
    </div>

</body>
</html>
