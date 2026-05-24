@php
    $navLinks = [
        ['href' => '#home', 'label' => __('Home')],
        ['href' => '#services', 'label' => __('Services')],
        ['href' => '#process', 'label' => __('Process')],
        ['href' => '#contact', 'label' => __('Contact')],
    ];
@endphp
<nav class="fixed top-0 left-0 right-0 z-50" x-data="{
    open: false,
    dark: document.documentElement.classList.contains('dark'),
    toggleTheme() {
        this.dark = !this.dark;
        document.documentElement.classList.toggle('dark', this.dark);
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
    }
}">
    <div
        class="lg:mx-auto mx-4 mt-4 max-w-4xl rounded-full border border-white/15 bg-black/55 px-4 text-white shadow-lg shadow-black/10 backdrop-blur-xl backdrop-saturate-150 transition-colors dark:border-white/10 dark:bg-zinc-950/75 dark:shadow-cyan-950/20 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center justify-center">
                <a href="/" class="text-md sm:text-md font-bold  tracking-tight"
                    style="font-family: 'DynaPuff', system-ui;">
                    Yuk Ngoding
                </a>
            </div>

            {{-- Menu Desktop --}}
            <div class="md:flex items-center space-x-1 hidden sm:block">
                @foreach ($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                        class="px-3 py-2 rounded-md text-sm font-medium text-white/70 transition-colors hover:bg-white/10 hover:text-white">
                        {{ $link['label'] }}
                    </a>
                @endforeach


            </div>

            <div class="hidden sm:flex items-center">
                <button x-data="{ copied: false, hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                    @click="navigator.clipboard.writeText('yukngodinginaja@gmail.com'); copied = true; hover = false; setTimeout(() => copied = false, 2000)"
                    class="relative ml-4 flex h-9 min-w-56 cursor-pointer items-center justify-center overflow-hidden rounded-full bg-white px-6 py-2 text-sm font-medium text-black transition-colors dark:bg-cyan-300 dark:text-zinc-950">

                    {{-- Email text — slides up on hover/copied --}}
                    <span
                        class="absolute inset-0 flex items-center justify-center transition-transform duration-300 ease-in-out px-6"
                        :class="(hover || copied) ? '-translate-y-full' : 'translate-y-0'">
                        yukngodinginaja@gmail.com
                    </span>

                    {{-- Action text — slides up into view --}}
                    <span
                        class="absolute inset-0 flex items-center justify-center transition-transform duration-300 ease-in-out"
                        :class="(hover || copied) ? 'translate-y-0' : 'translate-y-full'"
                        x-text="copied ? @js(__('Copied!')) : @js(__('Click to copy'))">
                    </span>
                </button>
                <a href="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}"
                    class="ml-2 grid h-9 min-w-9 place-items-center rounded-full border border-white/10 bg-white/10 px-3 text-xs font-black text-white transition-colors hover:bg-white/20">
                    {{ strtoupper(app()->getLocale() === 'id' ? 'en' : 'id') }}
                </a>
                <button @click="toggleTheme()" type="button"
                    class="ml-2 grid h-9 w-9 place-items-center rounded-full border border-white/10 bg-white/10 text-white transition-colors hover:bg-white/20"
                    :aria-label="dark ? @js(__('Activate light theme')) : @js(__('Activate dark theme'))">
                    <svg x-show="!dark" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 15.5a8.25 8.25 0 0 1-10.9-10.9 8.25 8.25 0 1 0 10.9 10.9Z" />
                    </svg>
                    <svg x-show="dark" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36 6.36-1.59-1.59M7.23 7.23 5.64 5.64m12.72 0-1.59 1.59M7.23 16.77l-1.59 1.59M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                    </svg>
                </button>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = !open" type="button"
                    class="p-2 rounded-full text-white/80 transition-colors hover:bg-white/10 hover:text-white"
                    :aria-expanded="open.toString()">
                    <span class="sr-only">{{ __('Toggle menu') }}</span>
                    <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="absolute inset-x-0 mx-4 top-24 md:hidden border border-secondary/30 bg-white/90 backdrop-blur-md dark:border-secondary/40 dark:bg-zinc-950/95 rounded-3xl shadow-lg shadow-black/10  p-2">
        <div class="px-4 pt-2 pb-3 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" @click="open = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-white">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
        <div
            class="mx-auto flex max-w-xl items-center gap-3 border-t border-secondary/30 px-4 py-3 dark:border-secondary/40">
            <button x-data="{ copied: false, hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                @click="navigator.clipboard.writeText('yukngodinginaja@gmail.com'); copied = true; hover = false; setTimeout(() => copied = false, 2000)"
                class="relative flex h-10 min-w-0 flex-1 cursor-pointer items-center justify-center overflow-hidden rounded-full bg-zinc-950 px-4 py-2 text-sm font-medium text-white transition-colors dark:bg-cyan-300 dark:text-zinc-950">

                {{-- Email text — slides up on hover/copied --}}
                <span
                    class="absolute inset-0 flex items-center justify-center transition-transform duration-300 ease-in-out px-6"
                    :class="(hover || copied) ? '-translate-y-full' : 'translate-y-0'">
                    yukngodinginaja@gmail.com
                </span>

                {{-- Action text — slides up into view --}}
                <span
                    class="absolute inset-0 flex items-center justify-center transition-transform duration-300 ease-in-out"
                    :class="(hover || copied) ? 'translate-y-0' : 'translate-y-full'"
                    x-text="copied ? @js(__('Copied!')) : @js(__('Click to copy'))">
                </span>
            </button>
            <a href="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}"
                class="grid h-10 min-w-10 shrink-0 place-items-center rounded-full border border-zinc-950/10 bg-zinc-950/10 px-3 text-xs font-black text-zinc-950 transition-colors hover:bg-zinc-950/15 dark:border-white/10 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                {{ strtoupper(app()->getLocale() === 'id' ? 'en' : 'id') }}
            </a>
            <button @click="toggleTheme()" type="button"
                class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-zinc-950/10 bg-zinc-950/10 text-zinc-950 transition-colors hover:bg-zinc-950/15 dark:border-white/10 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                :aria-label="dark ? @js(__('Activate light theme')) : @js(__('Activate dark theme'))">
                <svg x-show="!dark" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 15.5a8.25 8.25 0 0 1-10.9-10.9 8.25 8.25 0 1 0 10.9 10.9Z" />
                </svg>
                <svg x-show="dark" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36 6.36-1.59-1.59M7.23 7.23 5.64 5.64m12.72 0-1.59 1.59M7.23 16.77l-1.59 1.59M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                </svg>
            </button>
        </div>
    </div>
</nav>
