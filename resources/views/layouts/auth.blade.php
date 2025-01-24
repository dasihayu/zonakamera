<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonakamera - @yield('title')</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center font-manrope">
    <div class="w-full max-w-md md:max-w-lg lg:max-w-xl overflow-hidden">
        <!-- Header -->
        <div class="py-6 text-center">
            <img src="{{ asset('storage/' . $brandLogo) }}"class="w-48 mx-auto" alt="">
        </div>
        <!-- Content -->
        <div class="">
            @yield('content')
        </div>
    </div>
</body>
</html>
