<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Class</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-900 font-sans antialiased ">


<nav class="bg-neutral-900 border-b border-neutral-150 mb-8">
    <div class="ml-4  mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between   ">
        <a href="{{ route('discussions.index') }}" class="font-grobold font-bold text-xl text-white hover:text-gray-300">
            Community Class
        </a>
        <div class="flex items-center gap-4 text-sm font-medium font-grobold text-white ml-4">
            <a href="{{ route('discussions.index') }}" class="hover:text-gray-300 transition">Forum</a>
            <a href="#" class=" hover:text-gray-300 transition">Pengumuman</a>
        </div>
    </div>
</nav>


<main>
    @yield('content')
</main>

</body>
</html>
