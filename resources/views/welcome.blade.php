<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('Yuk Ngoding - Jasa Joki Coding Web & Mobile') }}</title>

    <link rel="icon" href="{{ asset('build/assets/images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('build/assets/images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <script>
        (() => {
            const theme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @fonts
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        referrerpolicy="no-referrer">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap" rel="stylesheet">
</head>

<body class="home-shell min-h-screen overflow-x-hidden text-zinc-950 transition-colors duration-500 dark:text-zinc-50">
    <x-app-navbar />
    <x-floating-button />

    <main>
        <x-home.hero-section />

        <x-home.content-band-section />

        <x-home.path-section />

        <x-home.contact-us-section />
    </main>
    <x-footer />
</body>

</html>
