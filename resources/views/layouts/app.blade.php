<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Care - {{ $title ?? '-' }}</title>
    <link href="{{ asset('css/front/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins";
            color: #270738;
        }
    </style>

    @stack('styles')
</head>

<body>
    <main
        class="bg-[#FAFAFA] max-w-[640px] mx-auto min-h-screen relative flex flex-col has-[#CTA-nav]:pb-[120px] has-[#Bottom-nav]:pb-[120px]">
        @yield('content')

        @include('includes.bottom-navigation')
    </main>

    @stack('scripts')
</body>

</html>
