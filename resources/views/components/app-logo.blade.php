@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Yuk Ngoding" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center overflow-hidden rounded-md bg-white text-zinc-950 shadow-sm ring-1 ring-zinc-200 dark:ring-white/10">
            <img src="{{ asset('build/assets/images/logo.png') }}" alt="Yuk Ngoding" class="size-7 object-contain" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Yuk Ngoding" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center overflow-hidden rounded-md bg-white text-zinc-950 shadow-sm ring-1 ring-zinc-200 dark:ring-white/10">
            <img src="{{ asset('build/assets/images/logo.png') }}" alt="Yuk Ngoding" class="size-7 object-contain" />
        </x-slot>
    </flux:brand>
@endif
