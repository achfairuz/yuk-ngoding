<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

@php
    $sidebarContactCount = 0;

    try {
        $sidebarContactCount = \App\Models\contact::count();
    } catch (\Throwable) {
        $sidebarContactCount = 0;
    }
@endphp

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-white dark:border-white/10 dark:bg-zinc-950">
        <flux:sidebar.header class="border-b border-zinc-200/80 pb-4 dark:border-white/10">
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <div class="mx-2 my-4 rounded-lg border border-cyan-500/20 bg-cyan-500/10 p-4 dark:border-cyan-300/20 dark:bg-cyan-300/10">
            <div class="flex items-center gap-3">
                <div class="grid size-10 place-items-center rounded-lg bg-zinc-950 text-white dark:bg-cyan-300 dark:text-zinc-950">
                    <flux:icon icon="sparkles" class="size-5" />
                </div>
                <div class="min-w-0">
                    <p class="truncate text-sm font-black text-zinc-950 dark:text-white">{{ __('Workspace') }}</p>
                    <p class="truncate text-xs font-semibold text-zinc-600 dark:text-zinc-400">{{ __('Kelola brief project') }}</p>
                </div>
            </div>
        </div>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Menu')" class="grid">
                <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="inbox" :href="route('contacts.index')" :current="request()->routeIs('contacts.*')"
                    wire:navigate>
                    <span class="flex w-full items-center justify-between gap-3">
                        <span>{{ __('Contact') }}</span>
                        <span class="rounded-full bg-cyan-500/15 px-2 py-0.5 text-xs font-black text-cyan-700 dark:bg-cyan-300/15 dark:text-cyan-300">
                            {{ $sidebarContactCount }}
                        </span>
                    </span>
                </flux:sidebar.item>

                <flux:sidebar.item icon="cog" :href="route('profile.edit')" :current="request()->routeIs('profile.edit', 'appearance.edit')"
                    wire:navigate>
                    {{ __('Settings') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <div class="mx-2 mt-4 rounded-lg border border-zinc-200 p-2 dark:border-white/10">
            <p class="px-2 pb-2 text-xs font-black uppercase text-zinc-500 dark:text-zinc-400">{{ __('Language') }}</p>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('language.switch', 'id') }}"
                    class="rounded-md px-3 py-2 text-center text-xs font-black transition {{ app()->getLocale() === 'id' ? 'bg-zinc-950 text-white dark:bg-cyan-300 dark:text-zinc-950' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200 dark:bg-white/5 dark:text-zinc-300 dark:hover:bg-white/10' }}">
                    ID
                </a>
                <a href="{{ route('language.switch', 'en') }}"
                    class="rounded-md px-3 py-2 text-center text-xs font-black transition {{ app()->getLocale() === 'en' ? 'bg-zinc-950 text-white dark:bg-cyan-300 dark:text-zinc-950' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200 dark:bg-white/5 dark:text-zinc-300 dark:hover:bg-white/10' }}">
                    EN
                </a>
            </div>
        </div>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="globe-alt" :href="route('home')" target="_blank">
                {{ __('Website') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs" target="_blank">
                {{ __('Docs') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                    <flux:menu.item :href="route('contacts.index')" icon="inbox" wire:navigate>
                        {{ __('Contact') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <div class="grid grid-cols-2 gap-2 px-1 py-1">
                    <a href="{{ route('language.switch', 'id') }}"
                        class="rounded-md px-3 py-2 text-center text-xs font-black transition {{ app()->getLocale() === 'id' ? 'bg-zinc-950 text-white dark:bg-cyan-300 dark:text-zinc-950' : 'bg-zinc-100 text-zinc-700 dark:bg-white/5 dark:text-zinc-300' }}">
                        ID
                    </a>
                    <a href="{{ route('language.switch', 'en') }}"
                        class="rounded-md px-3 py-2 text-center text-xs font-black transition {{ app()->getLocale() === 'en' ? 'bg-zinc-950 text-white dark:bg-cyan-300 dark:text-zinc-950' : 'bg-zinc-100 text-zinc-700 dark:bg-white/5 dark:text-zinc-300' }}">
                        EN
                    </a>
                </div>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex w-full cursor-pointer items-center rounded-md px-2 py-1.5 text-start text-sm font-medium text-zinc-800 focus:outline-hidden data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600"
                        data-flux-menu-item data-flux-menu-item-has-icon data-test="logout-button">
                        <flux:icon icon="arrow-right-start-on-rectangle" variant="mini"
                            class="me-2 text-zinc-400 dark:text-white/60" data-flux-menu-item-icon />
                        {{ __('Log out') }}
                    </button>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
