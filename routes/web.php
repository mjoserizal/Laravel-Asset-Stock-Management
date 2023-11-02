<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AssetsController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LandingPageController;

Route::redirect('/wp-admin', '/login');
Route::get('/', [LandingPageController::class, 'landingPage'])->name('landingPage');
Route::get('/alat', [LandingPageController::class, 'landingPageAlat'])->name('landingPageAlat');
Route::get('/disposable', [LandingPageController::class, 'landingPageDisposable'])->name('landingPageDisposable');
Route::get('/exportPDF', [ExportController::class, 'exportPdf'])->name('exportPdf');
Route::get('/exportTransaksiPDF', [ExportController::class, 'exportLaporanTransaksi'])->name('exportLaporanTransaksi');

Route::view('/register', 'register')->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::redirect('/wp-admin', '/login')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Assets
    Route::delete('assets/destroy', 'AssetsController@massDestroy')->name('assets.massDestroy');
    Route::resource('assets', 'AssetsController');
    //Disposable
    Route::resource('disposable', 'DisposableController');
    Route::resource('alat', 'AlatController');
    //alat
    Route::resource('stocksDisposable', 'StockDisposableController');
    Route::resource('stocksAlat', 'StockAlatController');


    Route::resource('transactionsDisposable', 'TransactionsDisposableController');
    Route::resource('transactionsAlat', 'TransactionsAlatController');
    Route::post('transactions/{stock}/storeStockAlat', 'TransactionsAlatController@storeStockAlat')->name('transactionsAlat.storeStockAlat');
    Route::post('transactions/{stock}/storeStockDisposable', 'TransactionsDisposableController@storeStockDisposable')->name('transactionsDisposable.storeStockDisposable');
    //pdf
    Route::get('admin/assets/pdf', 'AssetsController@exportPdf')->name('admin.assets.exportPdf');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    //JenisObat
    Route::delete('jenisobats/destroy', 'JenisObatController@massDestroy')->name('jenisobat.massDestroy');
    Route::resource('jenisobats', 'JenisObatController');
    // Stocks
    //Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');
    Route::resource('stocks', 'StocksController')->only(['index', 'show']);

    // Transactions
    //    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::post('transactions/{stock}/storeStock', 'TransactionsController@storeStock')->name('transactions.storeStock');

    Route::resource('transactions', 'TransactionsController')->only(['index']);

    Route::get('transactions/{id}/', 'TransactionsController@statusTransaction')->name('transactions.statusTransaction');
    Route::get('transactionsDis/{id}/', 'TransactionsController@transDisStatus')->name('transactions.transDisStatus');
    Route::get('transactionsAl/{id}/', 'TransactionsController@transAlStatus')->name('transactions.transAlStatus');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
