<?php

use App\Models\User as UserModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Requests\AuthKitAuthenticationRequest;
use Laravel\WorkOS\Http\Requests\AuthKitLoginRequest;
use Laravel\WorkOS\Http\Requests\AuthKitLogoutRequest;
use Laravel\WorkOS\User as WorkOSUser;

Route::middleware(['guest'])->group(function () {
    Route::get('login', fn (AuthKitLoginRequest $request) => $request->redirect())->name('login');

    Route::get('authenticate', fn (AuthKitAuthenticationRequest $request) => tap(
        redirect()->intended(route('dashboard')),
        fn () => $request->authenticate(
            findUsing: fn (WorkOSUser $user) => UserModel::where('email', $user->email)->first(),
            createUsing: fn (WorkOSUser $user) => abort(403, 'Email ini tidak terdaftar.'),
            updateUsing: function (Authenticatable $existingUser, WorkOSUser $user): Authenticatable {
                $existingUser->forceFill([
                    'workos_id' => $user->id,
                    'avatar' => $user->avatar ?? '',
                    'email_verified_at' => now(),
                ])->save();

                return $existingUser;
            },
        ),
    ));
});

Route::post('logout', fn (AuthKitLogoutRequest $request) => $request->logout())
    ->middleware(['auth'])->name('logout');
