@php
    $navLinks = [
        ['href' => '/', 'label' => 'Home', 'route' => 'home'],
        ['href' => '/comics', 'label' => 'Comics', 'route' => null],
        ['href' => '/genres', 'label' => 'Genres', 'route' => null],
        ['href' => '/about', 'label' => 'About', 'route' => null],
    ];
@endphp
<footer class="my-4 text-center text-sm text-gray-500">
    &copy; {{ date('Y') }} {{ __('Yuk Ngoding. All rights reserved.') }}
</footer>
