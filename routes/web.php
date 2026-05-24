<?php

use App\Livewire\Contacts\Index as ContactInbox;
use App\Models\contact as Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

Route::view('/', 'welcome')->name('home');

Route::get('language/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'id'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('language.switch');

Route::post('contacts', function (Request $request) {
    $adminEmails = ['yukngodinginaja@gmail.com'];
    $adminPhones = ['6287784213202'];

    $normalizePhone = function (string $value): string {
        $phone = preg_replace('/\D+/', '', $value);

        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        if (str_starts_with($phone, '8')) {
            return '62' . $phone;
        }

        return $phone;
    };

    $request->merge([
        'contact' => trim((string) $request->input('contact')),
    ]);

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'contact' => [
            'required',
            'string',
            'max:255',
            function (string $attribute, mixed $value, Closure $fail) use ($adminEmails, $adminPhones, $normalizePhone): void {
                $contact = trim((string) $value);

                if (str_contains($contact, '@')) {
                    if (! filter_var($contact, FILTER_VALIDATE_EMAIL)) {
                        $fail(__('Kontak harus berupa email valid atau nomor WhatsApp valid.'));

                        return;
                    }

                    if (in_array(strtolower($contact), $adminEmails, true)) {
                        $fail(__('Gunakan email kamu sendiri, bukan email admin.'));
                    }

                    return;
                }

                $phone = $normalizePhone($contact);

                if (! preg_match('/^62[0-9]{8,13}$/', $phone)) {
                    $fail(__('Kontak harus berupa email valid atau nomor WhatsApp valid.'));

                    return;
                }

                if (in_array($phone, $adminPhones, true)) {
                    $fail(__('Gunakan nomor WhatsApp kamu sendiri, bukan nomor admin.'));
                }
            },
        ],
        'project_type' => ['required', 'string', 'max:255'],
        'message' => ['required', 'string', 'max:5000'],
    ]);

    Contact::create($validated);

    return back()->with('contact_status', __('Brief kamu sudah masuk. Kami akan balas secepatnya.'));
})->name('contacts.store');

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::get('dashboard', function () {
        $latestContacts = Contact::latest()->take(5)->get();

        return view('dashboard', [
            'contactCount' => Contact::count(),
            'todayContactCount' => Contact::whereDate('created_at', today())->count(),
            'weekContactCount' => Contact::where('created_at', '>=', now()->subDays(7))->count(),
            'latestContacts' => $latestContacts,
            'topProjectTypes' => Contact::selectRaw('project_type, count(*) as total')
                ->groupBy('project_type')
                ->orderByDesc('total')
                ->take(4)
                ->get(),
        ]);
    })->name('dashboard');

    Route::livewire('contacts', ContactInbox::class)->name('contacts.index');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
