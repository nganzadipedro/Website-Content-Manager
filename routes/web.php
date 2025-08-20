<?php

use Illuminate\Support\Facades\{
    Auth,
    Route
};

use App\Http\Livewire\Candidato\Dashboard as CandidatoDashboard;

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => 'guest'], function () {


    Route::post('login', 'Controllers\Auth\LoginController@login')->name('login');
    Route::get('login', 'Controllers\Auth\LoginController@showLoginForm')->name('login');

    Route::get('/forgot-password', 'Controllers\Auth\ForgotPasswordController@getEmail')->name('getfpview');
    Route::post('/forgot-password', 'Controllers\Auth\ForgotPasswordController@postEmail')->name('postfp');
    Route::get('/reset-password/{token}', 'Controllers\Auth\ResetPasswordController@getPassword')->name('getrspview');
    Route::post('/reset-password', 'Controllers\Auth\ResetPasswordController@updatePassword')->name('postrsp');
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
                Route::get('/newslater/list', 'Livewire\Admin\Listarnoticia')->name('listnoticia');
                Route::get('/newslater/edit/{hash}', 'Livewire\Admin\Editarnoticia')->name('editnoticia');
                Route::get('/users/list', 'Livewire\Admin\Listarusuario')->name('listusuario');
                Route::get('/lawyers/list', 'Livewire\Admin\Listaradvogados')->name('listadvogados');
                Route::get('/lawyers-trainee/list', 'Livewire\Admin\Listaradvogadosestagiarios')->name('listadvogadosestagiarios');
                Route::get('/lawyer-details/{hash}', 'Livewire\Admin\Detalhesadvogado')->name('detalhesadvogado');


                Route::post('/newslater/post', 'Controllers\PostController@newslater_post');
                Route::post('/newslater/delete', 'Controllers\PostController@delete_news');
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
