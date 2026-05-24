<section id="contact" class="contact-section px-5 py-24 sm:px-8 lg:px-12" data-gsap-contact-section>
    @if (session('contact_status') || $errors->any())
        <div class="fixed right-4 top-24 z-[70] w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-border bg-surface p-4 text-foreground shadow-[0_24px_70px_rgba(0,0,0,0.18)] backdrop-blur-2xl dark:border-white/10 dark:bg-zinc-950/95"
            x-data="{ show: true }" x-show="show" x-transition.opacity.duration.200ms>
            <div class="flex items-start gap-3">
                <div
                    class="grid size-9 shrink-0 place-items-center rounded-full {{ session('contact_status') ? 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-300' : 'bg-red-500/15 text-red-600 dark:text-red-300' }}">
                    @if (session('contact_status'))
                        <i class="fa-solid fa-check text-sm"></i>
                    @else
                        <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <p class="text-sm font-black">
                        {{ session('contact_status') ? __('Brief terkirim') : __('Brief belum terkirim') }}
                    </p>
                    <p class="mt-1 text-sm leading-6 text-muted-foreground">
                        {{ session('contact_status') ?? $errors->first() }}
                    </p>
                </div>

                <button type="button" @click="show = false"
                    class="grid size-8 shrink-0 cursor-pointer place-items-center rounded-full text-muted-foreground transition hover:bg-black/5 hover:text-foreground dark:hover:bg-white/10"
                    aria-label="{{ __('Close notification') }}">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[0.92fr_1.08fr]">
        <div class="section-heading" data-gsap-contact-copy>
            <span>{{ __('Contact us') }}</span>
            <h2>{{ __('Siap bantu project kamu mulai dari brief kecil.') }}</h2>
            <p>{{ __('Kirim detail kebutuhan, deadline, dan referensi. Kami bantu cek scope lalu balas dengan estimasi yang jelas.') }}
            </p>



            <div class="mt-8 grid max-w-[30rem] gap-4 sm:grid-cols-2">
                <div class="rounded-[1.1rem] border border-border bg-surface-soft p-4 shadow-[0_18px_38px_var(--yn-card-shadow)] backdrop-blur-2xl"
                    data-gsap-contact-info>
                    <span class="block text-[0.82rem] font-extrabold  text-black/80">{{ __('Response') }}</span>
                    <strong class="mt-1 block text-[1.05rem] text-foreground">{{ __('1-3 jam') }}</strong>
                </div>
                <div class="rounded-[1.1rem] border border-border bg-surface-soft p-4 shadow-[0_18px_38px_var(--yn-card-shadow)] backdrop-blur-2xl"
                    data-gsap-contact-info>
                    <span class="block text-[0.82rem] font-extrabold  text-black/80">{{ __('Support') }}</span>
                    <strong class="mt-1 block text-[1.05rem] text-foreground">{{ __('Web, mobile, API') }}</strong>
                </div>
            </div>
        </div>

        <form
            class="grid gap-4 rounded-[1.4rem] border border-border bg-surface p-5 shadow-[0_26px_64px_var(--yn-card-shadow)] backdrop-blur-2xl sm:p-6"
            action="{{ route('contacts.store') }}" method="POST" data-gsap-contact-form>
            @csrf

            <div class="grid gap-2" data-gsap-contact-field>
                <label class="text-sm font-black text-foreground" for="contact-name">{{ __('Nama') }}</label>
                <input id="contact-name" name="name" type="text" value="{{ old('name') }}" required
                    placeholder="{{ __('Nama kamu') }}"
                    class="w-full rounded-2xl border border-border bg-surface-soft px-4 py-3 text-foreground outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15 placeholder:text-muted-foreground/70">
                @error('name')
                    <span class="text-sm font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid gap-2" data-gsap-contact-field>
                <label class="text-sm font-black text-foreground" for="contact-contact">{{ __('Kontak') }}</label>
                <input id="contact-contact" name="contact" type="text" value="{{ old('contact') }}" required
                    placeholder="{{ __('WhatsApp atau email') }}"
                    class="w-full rounded-2xl border border-border bg-surface-soft px-4 py-3 text-foreground outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15 placeholder:text-muted-foreground/70">
                @error('contact')
                    <span class="text-sm font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid gap-2" data-gsap-contact-field>
                <label class="text-sm font-black text-foreground"
                    for="contact-service">{{ __('Jenis project') }}</label>
                <select id="contact-service" name="project_type" required
                    class="w-full rounded-2xl border border-border bg-surface-soft px-4 py-3 text-foreground outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    @foreach (['Website', 'Mobile app', 'Bug fixing', 'Slicing UI', 'Integrasi API', 'Deploy'] as $projectType)
                        <option @selected(old('project_type') === $projectType)>{{ __($projectType) }}</option>
                    @endforeach
                </select>
                @error('project_type')
                    <span class="text-sm font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid gap-2" data-gsap-contact-field>
                <label class="text-sm font-black text-foreground"
                    for="contact-message">{{ __('Brief singkat') }}</label>
                <textarea id="contact-message" name="message" rows="5" required
                    placeholder="{{ __('Ceritakan fitur, deadline, link desain, atau error yang perlu dibantu') }}"
                    class="w-full resize-y rounded-2xl border border-border bg-surface-soft px-4 py-3 text-foreground outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15 placeholder:text-muted-foreground/70">{{ old('message') }}</textarea>
                @error('message')
                    <span class="text-sm font-bold text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button class="home-button home-button-primary w-full cursor-pointer border-0" type="submit"
                data-gsap-contact-field>
                {{ __('Kirim brief') }}
                <span aria-hidden="true">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </button>
        </form>
    </div>
</section>
