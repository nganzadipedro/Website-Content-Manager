<?php

use Illuminate\Support\Facades\{
    Auth,
    Route
};

use App\Http\Livewire\Candidato\Dashboard as CandidatoDashboard;

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'guest'], function () {

    Route::post('login', 'Controllers\Auth\LoginController@login')->name('login');
    Route::get('login', 'Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::get('/forgot-password', 'Controllers\Auth\ForgotPasswordController@getEmail')->name('getfpview');
    Route::post('/forgot-password', 'Controllers\Auth\ForgotPasswordController@postEmail')->name('postfp');
    Route::get('/reset-password/{token}', 'Controllers\Auth\ResetPasswordController@getPassword')->name('getrspview');
    Route::post('/reset-password', 'Controllers\Auth\ResetPasswordController@updatePassword')->name('postrsp');

    Route::get('home', 'Controllers\WebsiteController@home')->name('home');
    Route::get('contact', 'Controllers\WebsiteController@contact')->name('contact');
    Route::get('services', 'Controllers\WebsiteController@services')->name('services');
    Route::get('members', 'Controllers\WebsiteController@members')->name('members');
    Route::get('legal-assistance', 'Controllers\WebsiteController@legal_assistance')->name('legal_assistance');
    Route::get('news', 'Controllers\WebsiteController@news')->name('news');
    Route::get('comissions', 'Controllers\WebsiteController@comissions')->name('comissions');
    Route::get('gallery', 'Controllers\WebsiteController@gallery')->name('gallery');





});

Route::group(['middleware' => 'auth'], function () {

    Route::post('logout', 'Controllers\Auth\LoginController@logout')->name('logout');

    Route::prefix('system')->name('system.')->group(function () {

        Route::group(['middleware' => 'admin'], function () {
            Route::prefix('admin')->name('admin.')->group(function () {
                Route::get('/', function () {
                    return redirect('/system/admin/dashboard');
                });

                Route::get('/dashboard', 'Livewire\Admin\Dashboard')->name('dashboard');
                Route::get('/newslater/add', 'Livewire\Admin\Cadastrarnoticia')->name('cadnoticia');
                Route::get('/gallery/add', 'Livewire\Admin\Cadastrargaleria')->name('cadgaleria');
                Route::get('/newslater/list', 'Livewire\Admin\Listarnoticia')->name('listnoticia');
                Route::get('/gallery/list', 'Livewire\Admin\Listargaleria')->name('listgaleria');
                Route::get('/messages/list/{tipo}', 'Livewire\Admin\Listarmensagens')->name('listmessages');
                Route::get('/complaints/list/{tipo}', 'Livewire\Admin\Listardenuncias')->name('listdenuncias');
                Route::get('/newslater/edit/{hash}', 'Livewire\Admin\Editarnoticia')->name('editnoticia');
                Route::get('/users/list', 'Livewire\Admin\Listarusuario')->name('listusuario');


                Route::post('/newslater/post', 'Controllers\PostController@newslater_post');
                Route::post('/gallery/post', 'Controllers\PostController@gallery_post');
                Route::post('/complaint/post', 'Controllers\PostController@complaint_post');
                Route::post('/message/post', 'Controllers\PostController@message_post');
                Route::post('/newslater/delete', 'Controllers\PostController@delete_news');
                Route::post('/gallery/delete', 'Controllers\PostController@delete_gallery');
                Route::post('/newslater/update', 'Controllers\PostController@newslater_update');

            });
        });

        Route::group(['middleware' => 'advogado'], function () {
            Route::prefix('advogado')->name('advogado.')->group(function () {
                Route::get('/', function () {
                    return redirect('/system/advogado/dashboard');
                });

            });
        });

    });

});
