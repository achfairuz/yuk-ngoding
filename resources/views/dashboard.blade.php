<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <section class="overflow-hidden rounded-lg border border-zinc-200 bg-zinc-950 text-white dark:border-white/10">
            <div class="grid gap-6 p-6 lg:grid-cols-[1.4fr_0.6fr] lg:p-8">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-cyan-300/10 px-3 py-1 text-xs font-black uppercase text-cyan-200">
                        <span class="size-2 rounded-full bg-cyan-300"></span>
                        {{ __('Admin Workspace') }}
                    </div>
                    <h1 class="mt-5 max-w-3xl text-3xl font-black tracking-tight sm:text-4xl">
                        {{ __('Pantau brief masuk dan follow up project dari satu tempat.') }}
                    </h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-zinc-300">
                        {{ __('Dashboard ini merangkum request client, tipe project paling sering, dan brief terbaru yang perlu dibalas.') }}
                    </p>
                </div>

                <div class="rounded-lg border border-white/10 bg-white/5 p-5">
                    <p class="text-sm font-semibold text-zinc-300">{{ __('Logged in as') }}</p>
                    <div class="mt-4 flex items-center gap-3">
                        <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                        <div class="min-w-0">
                            <p class="truncate font-black">{{ auth()->user()->name }}</p>
                            <p class="truncate text-sm text-zinc-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('contacts.index') }}" wire:navigate
                        class="mt-5 inline-flex w-full items-center justify-center rounded-md bg-cyan-300 px-4 py-2.5 text-sm font-black text-zinc-950 transition hover:bg-cyan-200">
                        {{ __('Open Contact Inbox') }}
                    </a>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            <article class="rounded-lg border border-zinc-200 bg-white p-5 dark:border-white/10 dark:bg-zinc-900">
                <p class="text-sm font-bold text-zinc-500 dark:text-zinc-400">{{ __('Total briefs') }}</p>
                <div class="mt-3 flex items-end justify-between gap-4">
                    <p class="text-3xl font-black text-zinc-950 dark:text-white">{{ $contactCount }}</p>
                    <div class="grid size-10 place-items-center rounded-lg bg-cyan-500/10 text-cyan-600 dark:text-cyan-300">
                        <flux:icon icon="inbox" class="size-5" />
                    </div>
                </div>
            </article>

            <article class="rounded-lg border border-zinc-200 bg-white p-5 dark:border-white/10 dark:bg-zinc-900">
                <p class="text-sm font-bold text-zinc-500 dark:text-zinc-400">{{ __('Today') }}</p>
                <div class="mt-3 flex items-end justify-between gap-4">
                    <p class="text-3xl font-black text-zinc-950 dark:text-white">{{ $todayContactCount }}</p>
                    <div class="grid size-10 place-items-center rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-300">
                        <flux:icon icon="bolt" class="size-5" />
                    </div>
                </div>
            </article>

            <article class="rounded-lg border border-zinc-200 bg-white p-5 dark:border-white/10 dark:bg-zinc-900">
                <p class="text-sm font-bold text-zinc-500 dark:text-zinc-400">{{ __('Last 7 days') }}</p>
                <div class="mt-3 flex items-end justify-between gap-4">
                    <p class="text-3xl font-black text-zinc-950 dark:text-white">{{ $weekContactCount }}</p>
                    <div class="grid size-10 place-items-center rounded-lg bg-violet-500/10 text-violet-600 dark:text-violet-300">
                        <flux:icon icon="chart-bar" class="size-5" />
                    </div>
                </div>
            </article>

        </section>

        <section class="grid gap-6 xl:grid-cols-[1.35fr_0.65fr]">
            <div class="rounded-lg border border-zinc-200 bg-white dark:border-white/10 dark:bg-zinc-900">
                <div class="flex items-center justify-between gap-4 border-b border-zinc-200 p-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-black text-zinc-950 dark:text-white">{{ __('Latest briefs') }}</h2>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Prioritaskan request terbaru yang butuh respon cepat.') }}</p>
                    </div>
                    <a href="{{ route('contacts.index') }}" wire:navigate class="text-sm font-black text-cyan-700 hover:underline dark:text-cyan-300">
                        {{ __('View all') }}
                    </a>
                </div>

                @if ($latestContacts->isEmpty())
                    <div class="grid min-h-72 place-items-center p-6 text-center">
                        <div>
                            <div class="mx-auto grid size-12 place-items-center rounded-lg bg-zinc-100 text-zinc-600 dark:bg-white/5 dark:text-zinc-300">
                                <flux:icon icon="inbox" class="size-6" />
                            </div>
                            <h3 class="mt-4 font-black text-zinc-950 dark:text-white">{{ __('Belum ada brief masuk') }}</h3>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Brief dari form contact halaman depan akan tampil otomatis di halaman ini.') }}</p>
                        </div>
                    </div>
                @else
                    <div class="divide-y divide-zinc-200 dark:divide-white/10">
                        @foreach ($latestContacts as $contact)
                            <div class="grid gap-4 p-5 md:grid-cols-[1fr_auto]">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <p class="font-black text-zinc-950 dark:text-white">{{ $contact->name }}</p>
                                        <span class="rounded-full bg-cyan-500/10 px-2.5 py-1 text-xs font-black text-cyan-700 dark:text-cyan-300">{{ $contact->project_type }}</span>
                                    </div>
                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $contact->message }}</p>
                                    <p class="mt-2 font-mono text-xs text-zinc-500 dark:text-zinc-500">{{ $contact->id }}</p>
                                </div>
                                <div class="text-sm font-semibold text-zinc-500 dark:text-zinc-400">
                                    {{ $contact->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="grid gap-6">
                <div class="rounded-lg border border-zinc-200 bg-white p-5 dark:border-white/10 dark:bg-zinc-900">
                    <h2 class="text-lg font-black text-zinc-950 dark:text-white">{{ __('Project mix') }}</h2>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Tipe request yang paling sering masuk.') }}</p>

                    <div class="mt-5 grid gap-3">
                        @forelse ($topProjectTypes as $projectType)
                            <div class="flex items-center justify-between gap-3 rounded-lg bg-zinc-50 px-3 py-3 dark:bg-white/5">
                                <span class="font-bold text-zinc-800 dark:text-zinc-200">{{ $projectType->project_type }}</span>
                                <span class="rounded-full bg-zinc-950 px-2.5 py-1 text-xs font-black text-white dark:bg-cyan-300 dark:text-zinc-950">{{ $projectType->total }}</span>
                            </div>
                        @empty
                            <p class="rounded-lg bg-zinc-50 px-3 py-4 text-sm text-zinc-500 dark:bg-white/5 dark:text-zinc-400">{{ __('Belum ada data project.') }}</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-lg border border-zinc-200 bg-white p-5 dark:border-white/10 dark:bg-zinc-900">
                    <h2 class="text-lg font-black text-zinc-950 dark:text-white">{{ __('Quick actions') }}</h2>
                    <div class="mt-4 grid gap-3">
                        <a href="{{ route('home') }}#contact" target="_blank"
                            class="flex items-center justify-between rounded-lg border border-zinc-200 px-4 py-3 text-sm font-black text-zinc-800 transition hover:border-cyan-300 hover:text-cyan-700 dark:border-white/10 dark:text-zinc-200 dark:hover:border-cyan-300/50 dark:hover:text-cyan-300">
                            {{ __('Preview contact form') }}
                            <flux:icon icon="arrow-top-right-on-square" class="size-4" />
                        </a>
                        <a href="{{ route('contacts.index') }}" wire:navigate
                            class="flex items-center justify-between rounded-lg border border-zinc-200 px-4 py-3 text-sm font-black text-zinc-800 transition hover:border-cyan-300 hover:text-cyan-700 dark:border-white/10 dark:text-zinc-200 dark:hover:border-cyan-300/50 dark:hover:text-cyan-300">
                            {{ __('Manage briefs') }}
                            <flux:icon icon="chevron-right" class="size-4" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts::app>
