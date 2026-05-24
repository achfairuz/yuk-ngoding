 <section id="process" class="path-section px-5 py-20 sm:px-8 lg:px-12" data-gsap-path-section>
     <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[0.8fr_1.2fr]">
         <div class="section-heading" data-gsap-path-heading>
             <span>{{ __('Alur pengerjaan') }}</span>
             <h2>{{ __('Dari brief sampai project siap dipakai.') }}</h2>
             <p>{{ __('Kirim kebutuhan project, kami bantu pecah scope, estimasi, pengerjaan, revisi, sampai file siap digunakan.') }}</p>
         </div>

         @php
             $items = [
                 [
                     'step' => __('Kirim brief'),
                     'desc' => __('Ceritakan kebutuhan, deadline, fitur, desain, dan platform yang ingin dibuat.'),
                 ],
                 [
                     'step' => __('Estimasi scope'),
                     'desc' => __('Kami bantu susun batas pekerjaan, harga, dan waktu pengerjaan yang masuk akal.'),
                 ],
                 [
                     'step' => __('Pengerjaan'),
                     'desc' => __('Project dikerjakan bertahap dengan update agar progresnya tetap jelas.'),
                 ],
                 [
                     'step' => __('Revisi & serah terima'),
                     'desc' => __('Hasil dicek, direvisi jika perlu, lalu file dan panduan singkat diserahkan.'),
                 ],
             ];
         @endphp
         <div class="path-list">
             <div class="path-line" data-gsap-path-line></div>
             @foreach ($items as $item)
                 <div class="path-item" data-gsap-path-item>
                     <div class="path-dot"></div>
                     <div>
                         <h3>{{ $item['step'] }}</h3>
                         <p>{{ $item['desc'] }}</p>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
