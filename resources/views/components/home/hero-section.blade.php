<section id="home" class="hero-section relative isolate min-h-screen overflow-hidden px-5 pb-16 pt-32 sm:px-8 lg:px-12"
    data-gsap-hero-section>
    <div class="hero-grid absolute inset-0 -z-20"></div>
    <div class="hero-glow hero-glow-one"></div>
    <div class="hero-glow hero-glow-two"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-[1.04fr_0.96fr]">
        <div class="max-w-3xl" data-gsap-hero-copy>
            <div
                class="mb-6 inline-flex items-center gap-3 rounded-full border border-zinc-900/10 bg-white/70 px-4 py-2 text-sm font-semibold text-zinc-700 shadow-sm backdrop-blur dark:border-white/10 dark:bg-white/10 dark:text-zinc-200">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-[0_0_18px_rgba(16,185,129,.9)]"></span>
                {{ __('Jasa joki coding untuk web, mobile, UI, bug fixing, dan deploy.') }}
            </div>

            <h1
                class="max-w-4xl text-5xl font-black leading-[.95] tracking-normal text-zinc-950 dark:text-white sm:text-6xl lg:text-7xl">
                {{ __('Yuk Ngoding,') }}
                <span class="text-gradient">{{ __('bantu beresin project') }}</span>
                {{ __('tanpa ribet.') }}
            </h1>

            <p class="mt-7 max-w-2xl text-lg leading-8 text-zinc-600 dark:text-zinc-300 sm:text-xl">
                {{ __('Bantu kerjakan website, aplikasi mobile, slicing UI, integrasi API, perbaikan bug, sampai deploy supaya project kamu siap dipakai.') }}
            </p>

            <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                <a href="#contact" class="home-button home-button-primary">
                    {{ __('Konsultasi project') }}
                    <span aria-hidden="true">-></span>
                </a>
                <a href="#services" class="home-button home-button-secondary">
                    {{ __('Lihat layanan') }}
                </a>
            </div>

            <div class="mt-12 grid max-w-xl grid-cols-3 gap-4">
                <div class="metric-card" data-gsap-hero-metric>
                    <span>50+</span>
                    {{ __('Project dibantu') }}
                </div>
                <div class="metric-card" data-gsap-hero-metric>
                    <span>Web</span>
                    {{ __('Laravel, React, UI') }}
                </div>
                <div class="metric-card" data-gsap-hero-metric>
                    <span>Mobile</span>
                    {{ __('Android & API') }}
                </div>
            </div>
        </div>

        <div class="relative" data-gsap-hero-code>
            <div class="code-orbit code-orbit-a"></div>
            <div class="code-orbit code-orbit-b"></div>

            <div class="code-window">
                <div class="code-toolbar">
                    <div class="flex gap-2">
                        <span class="dot bg-red-400"></span>
                        <span class="dot bg-amber-400"></span>
                        <span class="dot bg-emerald-400"></span>
                    </div>
                    <span>routes/web.php</span>
                </div>

                <div class="code-lines">
                    <p><span class="code-muted">01</span><span class="code-purple">Route</span>::view(<span
                            class="code-green">'/'</span>, <span class="code-green">'welcome'</span>);</p>
                    <p><span class="code-muted">02</span></p>
                    <p><span class="code-muted">03</span><span class="code-blue">class</span> YukNgodingController
                    </p>
                    <p><span class="code-muted">04</span>{</p>
                    <p><span class="code-muted">05</span> <span class="code-blue">public function</span> mulai()
                    </p>
                    <p><span class="code-muted">06</span> {</p>
                    <p><span class="code-muted">07</span> <span class="code-blue">return</span> <span
                            class="code-purple">view</span>(<span class="code-green">'ngoding.seru'</span>);</p>
                    <p><span class="code-muted">08</span> }</p>
                    <p><span class="code-muted">09</span>}</p>
                </div>

                <div class="console-card">
                    <span class="console-caret">$</span>
                    <span class="typing-text">php artisan semangat:belajar</span>
                </div>
            </div>
        </div>
    </div>
</section>
