  <section id="services" class="content-band px-5 py-20 sm:px-8 lg:px-12" data-gsap-feature-section>
      <div class="mx-auto max-w-7xl">
          <div class="section-heading" data-gsap-feature-heading>
              <span>{{ __('Kenapa pilih kami') }}</span>
              <h2>{{ __('Project dikerjakan rapi, jelas, dan siap dikembangkan.') }}</h2>
          </div>

          @php
              $features = [
                  [
                      'title' => __('Web & mobile'),
                      'body' =>
                          __('Bantu pembuatan website, aplikasi mobile, dashboard, landing page, sampai sistem admin.'),
                      'icon' => '01',
                  ],
                  [
                      'title' => __('Bug fixing'),
                      'body' =>
                          __('Error, tampilan berantakan, logic tidak jalan, atau integrasi API bisa dibantu ditelusuri.'),
                      'icon' => '02',
                  ],
                  [
                      'title' => __('Kode rapi'),
                      'body' => __('Struktur dibuat mudah dibaca, responsif, dan tetap enak kalau nanti mau dilanjutkan.'),
                      'icon' => '03',
                  ],
              ];
          @endphp

          <div class="mt-10 grid gap-5 md:grid-cols-3">
              @foreach ($features as $feature)
                  <article class="feature-card" data-gsap-feature-card>
                      <div class="feature-icon">{{ $feature['icon'] }}</div>
                      <h3>{{ $feature['title'] }}</h3>
                      <p>{{ $feature['body'] }}</p>
                  </article>
              @endforeach
          </div>
      </div>
  </section>
