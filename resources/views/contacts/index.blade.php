<div class="flex h-full w-full flex-1 flex-col gap-6">
    @if (session('contact_status'))
        <div class="rounded-lg border border-emerald-500/25 bg-emerald-500/10 px-4 py-3 text-sm font-bold text-emerald-700 dark:text-emerald-300">
            {{ session('contact_status') }}
        </div>
    @endif

        <div
            class="flex flex-col gap-4 border-b border-zinc-200 pb-6 dark:border-white/10 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-cyan-600 dark:text-cyan-300">{{ __('Yuk Ngoding') }}</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-zinc-950 dark:text-white">{{ __('Contact Inbox') }}</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                    {{ __('Semua brief dari form contact masuk ke sini untuk dicek, diprioritaskan, dan dibalas.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:min-w-80">
                <div class="rounded-lg border border-zinc-200 bg-white p-4 dark:border-white/10 dark:bg-zinc-900">
                    <p class="text-xs font-bold uppercase text-zinc-500 dark:text-zinc-400">{{ __('Total brief') }}</p>
                    <p class="mt-2 text-2xl font-black text-zinc-950 dark:text-white">{{ $contactCount }}</p>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-4 dark:border-white/10 dark:bg-zinc-900">
                    <p class="text-xs font-bold uppercase text-zinc-500 dark:text-zinc-400">{{ __('Filtered') }}</p>
                    <p class="mt-2 truncate text-sm font-bold text-zinc-950 dark:text-white">
                        {{ $filteredContactCount }} {{ __('brief') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid gap-3 rounded-lg border border-zinc-200 bg-white p-4 dark:border-white/10 dark:bg-zinc-900 lg:grid-cols-[1fr_16rem]">
            <div>
                <label class="sr-only" for="contact-search">{{ __('Search') }}</label>
                <input id="contact-search" wire:model.live.debounce.300ms="search" type="search"
                    placeholder="{{ __('Cari nama, kontak, project, atau isi brief') }}"
                    class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/15 dark:border-white/10 dark:bg-zinc-950 dark:text-white dark:placeholder:text-zinc-500">
            </div>

            <div>
                <label class="sr-only" for="project-type-filter">{{ __('Project') }}</label>
                <select id="project-type-filter" wire:model.live="projectType"
                    class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-900 outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/15 dark:border-white/10 dark:bg-zinc-950 dark:text-white">
                    <option value="">{{ __('Semua project') }}</option>
                    @foreach ($projectTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($contacts->isEmpty())
            <div
                class="grid min-h-96 place-items-center rounded-lg border border-dashed border-zinc-300 bg-zinc-50 px-6 text-center dark:border-white/15 dark:bg-zinc-900/60">
                <div>
                    <div
                        class="mx-auto grid size-12 place-items-center rounded-lg bg-cyan-500/10 text-cyan-600 dark:text-cyan-300">
                        <flux:icon icon="inbox" class="size-6" />
                    </div>
                    <h2 class="mt-4 text-lg font-black text-zinc-950 dark:text-white">{{ __('Belum ada brief masuk') }}</h2>
                    <p class="mt-2 max-w-md text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                        {{ __('Brief dari form contact halaman depan akan tampil otomatis di halaman ini.') }}
                    </p>
                </div>
            </div>
        @else
            <div
                class="overflow-hidden rounded-lg border border-zinc-200 bg-white dark:border-white/10 dark:bg-zinc-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 text-sm dark:divide-white/10">
                        <thead
                            class="bg-zinc-50 text-left text-xs font-black uppercase text-zinc-500 dark:bg-zinc-950/50 dark:text-zinc-400">
                            <tr>
                                <th class="px-5 py-3">{{ __('Brief') }}</th>
                                <th class="px-5 py-3">{{ __('Kontak') }}</th>
                                <th class="px-5 py-3">{{ __('Project') }}</th>
                                <th class="px-5 py-3">{{ __('Masuk') }}</th>
                                <th class="px-5 py-3 text-right">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-white/10">
                            @foreach ($contacts as $contact)
                                <tr class="align-top transition hover:bg-zinc-50 dark:hover:bg-white/5">
                                    <td class="max-w-xl px-5 py-4">
                                        <div class="flex items-start gap-3">
                                            <div
                                                class="grid size-9 shrink-0 place-items-center rounded-lg bg-zinc-950 text-xs font-black text-white dark:bg-cyan-300 dark:text-zinc-950">
                                                {{ str($contact->name)->substr(0, 1)->upper() }}
                                            </div>
                                            <div>
                                                <div class="font-black text-zinc-950 dark:text-white">
                                                    {{ $contact->name }}</div>
                                                <div class="mt-1 font-mono text-xs text-cyan-600 dark:text-cyan-300">
                                                    {{ $contact->id }}</div>
                                                <p class="mt-2 line-clamp-3 leading-6 text-zinc-600 dark:text-zinc-400">
                                                    {{ $contact->message }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 font-semibold text-zinc-700 dark:text-zinc-300">
                                        <a href="{{ $this->contactHref($contact) }}"
                                            @if ($this->isContactPhone($contact)) target="_blank" rel="noopener noreferrer" @endif
                                            class="text-cyan-700 underline-offset-4 hover:underline dark:text-cyan-300">
                                            {{ $contact->contact }}
                                        </a>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-cyan-500/10 px-3 py-1 text-xs font-black text-cyan-700 dark:text-cyan-300">
                                            {{ $contact->project_type }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-zinc-600 dark:text-zinc-400">
                                        {{ $contact->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <button type="button"
                                            wire:click="delete('{{ $contact->id }}')"
                                            wire:confirm="{{ __('Yakin ingin menghapus brief ini?') }}"
                                            class="inline-flex cursor-pointer items-center rounded-md border border-red-500/20 px-3 py-1.5 text-xs font-black text-red-600 transition hover:bg-red-500/10 dark:text-red-300">
                                            {{ __('Hapus') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $contacts->links() }}
        @endif
</div>
