<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LicensesController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\TerminalController;
use App\Http\Middleware\checkLicense;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [AuthController::class, 'AuthPage'])->name('login');
Route::post('/login', [AuthController::class, 'AuthAction'])->name('login-action')->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout-action')->middleware('auth');
Route::get('/rates', [RatesController::class, 'index'])->name('rates-index')->middleware([checkLicense::class]);
Route::get('/export', [RatesController::class, 'rateExport'])->name('rates-export')->middleware([checkLicense::class]);
Route::get('/licenses', [LicensesController::class, 'licenses'])->name('licenses')->middleware('auth');
Route::get('/not-license', [LicensesController::class, 'notLicense'])->name('not-license')->middleware('auth');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'schoolsIndex'])->name('schools-show');
    Route::get('/{id}', [AdminController::class, 'schoolsEdit'])->name('schools-edit');
    Route::post('/{id}', [AdminController::class, 'schoolsAddLicense'])->name('schools-add-license');

});

Route::group(['prefix' => 'terminal', 'as' => 'terminal.'], function () {
    Route::get('/show/{id}', [TerminalController::class, 'show'])->name('show');
    Route::post('/{id}/rate', [TerminalController::class, 'rate'])->name('rate');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['kk', 'ru'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }

    return redirect()->back();
})->name('change.language');

Route::get('password/{password}', function ($password) {

    // Генерация хеша для переданного пароля

    $hashedPassword = Hash::make($password);

    // Возвращаем результат

    return response()->json([

        'original' => $password,

        'hashed' => $hashedPassword,

    ]);

});
