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
    Route::get('news-details/{hash}', 'Controllers\WebsiteController@news_details')->name('news_details');
    Route::get('list-lawyers', 'Controllers\WebsiteController@list_lawyers')->name('list_lawyers');
    Route::get('list-trainee', 'Controllers\WebsiteController@list_trainee')->name('list_trainee');
    Route::get('download-document/{file}', 'Controllers\WebsiteController@download_document')->name('download_doc');

    Route::post('/complaint/post', 'Controllers\PostController@complaint_post');
    Route::post('/message/post', 'Controllers\PostController@message_post');
    Route::post('/gallery-views/post', 'Controllers\PostController@gallery_views');
    Route::post('/search-lawyer/post', 'Controllers\PostController@search_lawyer');

    Route::get('/trata-dados', 'Controllers\WebsiteController@trans_dados');
    Route::get('/register-member', 'Controllers\UserController@register_member');

});

Route::group(['middleware' => 'auth'], function () {

    Route::post('logout', 'Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('newslater/add', 'Livewire\Admin\Cadastrarnoticia')->name('cadnoticia');
    Route::get('gallery/add', 'Livewire\Admin\Cadastrargaleria')->name('cadgaleria');
    Route::get('newslater/list', 'Livewire\Admin\Listarnoticia')->name('listnoticia');
    Route::get('gallery/list', 'Livewire\Admin\Listargaleria')->name('listgaleria');
    Route::get('newslater/edit/{hash}', 'Livewire\Admin\Editarnoticia')->name('editnoticia');

    Route::post('system/newslater/post', 'Controllers\PostController@newslater_post');
    Route::post('system/gallery/post', 'Controllers\PostController@gallery_post');
    Route::post('system/complaint/post', 'Controllers\PostController@complaint_post');
    Route::post('system/message/post', 'Controllers\PostController@message_post');
    Route::post('system/newslater/delete', 'Controllers\PostController@delete_news');
    Route::post('system/gallery/delete', 'Controllers\PostController@delete_gallery');
    Route::post('system/newslater/update', 'Controllers\PostController@newslater_update');
    Route::post('system/lawyier/update_data', 'Controllers\AdvogadoController@update_data');

    Route::get('system/getDaysWeek', 'Controllers\SystemController@diasUteis')->name('get_days_week');
    Route::get('system/getDaysMonth', 'Controllers\SystemController@registosPorDiaMesAtual')->name('get_days_month');
    Route::post('system/anexos/post', 'Controllers\SystemController@anexo_post');
    Route::post('system/encaminhar/post', 'Controllers\SystemController@encaminhar_post');

    Route::get('system/manage-website', 'Livewire\Geral\Gerenciarwebsite')->name('manage_website');
    Route::get('system/profile', 'Livewire\Geral\Perfil')->name('profile_user');

    Route::prefix('system')->name('system.')->group(function () {

        Route::group(['middleware' => 'admin'], function () {
            Route::prefix('admin')->name('admin.')->group(function () {
                Route::get('/', function () {
                    return redirect('/system/admin/dashboard');
                });

                Route::get('/dashboard', 'Livewire\Admin\Dashboard')->name('dashboard');
                Route::get('/dashboard-system', 'Livewire\Admin\Dashboardsistema')->name('dashboard_system');
                Route::get('/newslater/add', 'Livewire\Admin\Cadastrarnoticia')->name('cadnoticia');
                Route::get('/gallery/add', 'Livewire\Admin\Cadastrargaleria')->name('cadgaleria');
                Route::get('/newslater/list', 'Livewire\Admin\Listarnoticia')->name('listnoticia');
                Route::get('/gallery/list', 'Livewire\Admin\Listargaleria')->name('listgaleria');
                Route::get('/messages/list/{tipo}', 'Livewire\Admin\Listarmensagens')->name('listmessages');
                Route::get('/complaints/list/{tipo}', 'Livewire\Admin\Listardenuncias')->name('listdenuncias');
                Route::get('/newslater/edit/{hash}', 'Livewire\Admin\Editarnoticia')->name('editnoticia');
                Route::get('/messages/details/{hash}', 'Livewire\Admin\Detalhesmensagem')->name('detalhesmensagem');
                Route::get('/complaints/details/{hash}', 'Livewire\Admin\Detalhesdenuncia')->name('detalhesdenuncia');

                Route::get('/view/atachment/{filename}', 'Controllers\PostController@getfile')->name('getfile');
                Route::get('/list/trainees', 'Livewire\Admin\Listarestagiarios')->name('list_trainees');
                Route::get('/list/lawyers', 'Livewire\Admin\Listaradvogados')->name('list_lawyers');
                Route::get('/list/undefined', 'Livewire\Admin\Listarindefinidos')->name('list_undefined');
                Route::get('/edit-data/member/{hash}', 'Livewire\Admin\Editarassociado')->name('edit_member');

                Route::get('/new/user', 'Livewire\Admin\Cadastrarusuario')->name('new_user');
                Route::get('/users/list', 'Livewire\Admin\Listarusuario')->name('listusuario');
                Route::get('/users/members', 'Livewire\Admin\Listarassociados')->name('listassociados');
                Route::get('/users/edit/{id}', 'Livewire\Admin\Editarusuario')->name('edit_user');
                Route::get('/users/details/{id}', 'Livewire\Admin\Detalhesusuario')->name('detalhes_user');



                Route::get('/export-undefined', 'Controllers\AdvogadoController@export_undefined')->name('export_undefined');
                Route::get('/export-lawyers', 'Controllers\AdvogadoController@export_lawyers')->name('export_lawyers');
                Route::get('/export-trainees', 'Controllers\AdvogadoController@export_trainees')->name('export_trainees');

            });
        });

        Route::group(['middleware' => 'gestor'], function () {
            Route::prefix('gestor')->name('gestor.')->group(function () {
                Route::get('/', function () {
                    return redirect('/system/gestor/dashboard');
                });

                Route::get('/dashboard', 'Livewire\Admin\Dashboard')->name('dashboard');
                Route::get('/dashboard-system', 'Livewire\Admin\Dashboardsistema')->name('dashboard_system');
                Route::get('/newslater/add', 'Livewire\Admin\Cadastrarnoticia')->name('cadnoticia');
                Route::get('/gallery/add', 'Livewire\Admin\Cadastrargaleria')->name('cadgaleria');
                Route::get('/newslater/list', 'Livewire\Admin\Listarnoticia')->name('listnoticia');
                Route::get('/gallery/list', 'Livewire\Admin\Listargaleria')->name('listgaleria');
                Route::get('/newslater/edit/{hash}', 'Livewire\Admin\Editarnoticia')->name('editnoticia');

                Route::get('/messages/list/{tipo}', 'Livewire\Admin\Listarmensagens')->name('listmessages');
                Route::get('/complaints/list/{tipo}', 'Livewire\Admin\Listardenuncias')->name('listdenuncias');
                Route::get('/messages/details/{hash}', 'Livewire\Admin\Detalhesmensagem')->name('detalhesmensagem');
                Route::get('/complaints/details/{hash}', 'Livewire\Admin\Detalhesdenuncia')->name('detalhesdenuncia');

                Route::get('/view/atachment/{filename}', 'Controllers\PostController@getfile')->name('getfile');
                Route::get('/list/trainees', 'Livewire\Admin\Listarestagiarios')->name('list_trainees');
                Route::get('/list/lawyers', 'Livewire\Admin\Listaradvogados')->name('list_lawyers');
                Route::get('/list/undefined', 'Livewire\Admin\Listarindefinidos')->name('list_undefined');
                Route::get('/edit-data/member/{hash}', 'Livewire\Admin\Editarassociado')->name('edit_member');

                Route::get('/new/user', 'Livewire\Admin\Cadastrarusuario')->name('new_user');
                Route::get('/users/list', 'Livewire\Admin\Listarusuario')->name('listusuario');
                Route::get('/users/members', 'Livewire\Admin\Listarassociados')->name('listassociados');
                Route::get('/users/edit/{id}', 'Livewire\Admin\Editarusuario')->name('edit_user');
                Route::get('/users/details/{id}', 'Livewire\Admin\Detalhesusuario')->name('detalhes_user');

                Route::get('/export-undefined', 'Controllers\AdvogadoController@export_undefined')->name('export_undefined');
                Route::get('/export-lawyers', 'Controllers\AdvogadoController@export_lawyers')->name('export_lawyers');
                Route::get('/export-trainees', 'Controllers\AdvogadoController@export_trainees')->name('export_trainees');

            });
        });

        Route::group(['middleware' => 'secretaria'], function () {
            Route::prefix('secretaria')->name('secretaria.')->group(function () {

                Route::get('/', function () {
                    return redirect('/system/Secretaria/dashboard');
                });

                Route::get('/dashboard', 'Livewire\Secretaria\Dashboard')->name('dashboard');

                Route::get('/new/process', 'Livewire\Secretaria\Registarentrada')->name('registar_entrada');
                Route::get('/edit/process/{hash}', 'Livewire\Secretaria\Editarregisto')->name('editar_registo');
                Route::get('/list/process', 'Livewire\Secretaria\Listarregistos')->name('listar_registos');
                Route::get('/details/process/{hash}', 'Livewire\Secretaria\Detalhesregisto')->name('detalhes_registo');

            });
        });

        Route::group(['middleware' => 'areatecnica'], function () {
            Route::prefix('areatecnica')->name('areatecnica.')->group(function () {

                Route::get('/', function () {
                    return redirect('/system/areatecnica/dashboard');
                });

                Route::get('/dashboard', 'Livewire\Areatecnica\Dashboard')->name('dashboard');
                Route::get('/list/process', 'Livewire\Secretaria\Listarregistos')->name('listar_registos');
                Route::get('/list/assistance', 'Livewire\Areatecnica\Ajpendentes')->name('listar_pedidos_pendentes');
                Route::get('/details/process/{hash}', 'Livewire\Secretaria\Detalhesregisto')->name('detalhes_registo');
                Route::get('/archive/assistance/{hash}', 'Livewire\Areatecnica\Arquivarpedido')->name('arquivar_pedido');

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
