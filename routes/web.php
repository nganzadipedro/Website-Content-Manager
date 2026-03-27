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

    Route::get('/trata-dados', 'Controllers\SystemController@trata_patronos_3');
    Route::get('/testa-doc/{hash}', 'Controllers\SystemController@documento_assistencia');
    Route::get('/register-member', 'Controllers\UserController@register_member');

    Route::get('/defesa-oficiosa', 'Controllers\WebsiteController@defesa_oficiosa');
     Route::get('system/getAdvogadoByData/{tipo}/{numero}/{categoria}', 'Controllers\SystemController@getAdvogadoByData');

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
    Route::get('system/getDaysWeekAssistance', 'Controllers\SystemController@diasUteisAssistencia')->name('get_days_week_assistance');
    Route::get('system/getDaysWeekInscricaoAdvogado', 'Controllers\SystemController@diasUteisInscricaoAdvogado')->name('get_days_week_inscricao_advogado');
    Route::get('system/getDaysWeekInscricaoEstagiario', 'Controllers\SystemController@diasUteisInscricaoEstagiario')->name('get_days_week_inscricao_estagiario');
    Route::get('system/getDaysMonth', 'Controllers\SystemController@registosPorDiaMesAtual')->name('get_days_month');
    Route::get('system/getDaysMonthAssistance', 'Controllers\SystemController@registosPorDiaMesAtualAssistencia')->name('get_days_month_assistance');
    Route::get('system/getDaysMonthInscricaoAdvogado', 'Controllers\SystemController@registosPorDiaMesAtualInscricaoAdvogado')->name('get_days_month_inscricao_advogado');
    Route::get('system/getDaysMonthInscricaoEstagiario', 'Controllers\SystemController@registosPorDiaMesAtualInscricaoEstagiario')->name('get_days_month_inscricao_estagiario');

    Route::post('/alterar/senha', 'Controllers\UserController@updateSenha');
    Route::post('system/anexos/post', 'Controllers\SystemController@anexo_post');
    Route::post('system/encaminhar/post', 'Controllers\SystemController@encaminhar_post');
    Route::post('system/distribuicao/post', 'Controllers\SystemController@distribuicao_post');
    Route::post('system/distribuicao-grupo/post', 'Controllers\SystemController@distribuicao_grupo_post');
    Route::post('system/entrega-conselheiro-grupo/post', 'Controllers\SystemController@entrega_conselheiro_grupo_post');
    Route::post('system/remessa-comissaoetica-grupo/post', 'Controllers\SystemController@remessa_comissaoetica_grupo_post');
    Route::post('system/entrega-comissaoetica-grupo/post', 'Controllers\SystemController@entrega_comissaoetica_grupo_post');
    Route::post('system/entrega-comissaoetica-indeferido/post', 'Controllers\SystemController@entrega_comissaoetica_indeferido_post');
    Route::post('system/registo-associado/post', 'Controllers\SystemController@registo_associado_post');
    Route::post('system/registo-associado/update', 'Controllers\SystemController@registo_associado_update');
    Route::post('system/registo-remetercn/update', 'Controllers\SystemController@registo_remetercn_update');
    Route::post('system/registo-mudarindeferido/update', 'Controllers\SystemController@registo_mudarindeferido_update');
    Route::post('system/registoadicional-ceduladisponivel/update', 'Controllers\SystemController@registoadicional_ceduladisponivel');
    Route::post('system/registo-patrono/update', 'Controllers\SystemController@registo_patrono_update');
    Route::post('system/data-cerimonia/update', 'Controllers\SystemController@data_cerimonia_update');
    Route::post('system/pedido-intervencao/post', 'Controllers\SystemController@pedido_intervencao_post');
    Route::post('system/pedido-intervencao-novo/post', 'Controllers\SystemController@pedido_intervencao_novo_post');
    Route::post('system/pedido-intervencao/delete', 'Controllers\SystemController@pedido_intervencao_delete');
    Route::post('system/estagiario-patrono/delete', 'Controllers\SystemController@estagiario_patrono_delete');
    Route::post('system/registo-inscricao/post', 'Controllers\SystemController@registo_inscricao_post');
    Route::post('system/editar-inscricao-estagiario/post', 'Controllers\SystemController@editar_inscricao_estagiario_post');
    Route::post('system/atribuir-advogado/post', 'Controllers\SystemController@atribuir_advogado_post');
    Route::post('system/atribuir-advogado/delete', 'Controllers\SystemController@atribuir_advogado_delete');
    Route::post('system/registo-despacho/post', 'Controllers\SystemController@registo_despacho_post');
    Route::post('system/actualizar-despacho/post', 'Controllers\SystemController@actualizar_despacho_post');
    Route::get('system/manage-website', 'Livewire\Geral\Gerenciarwebsite')->name('manage_website');
    Route::get('system/profile', 'Livewire\Geral\Perfil')->name('profile_user');
    Route::get('system/log-activities', 'Livewire\Geral\Actividadessistema')->name('activities_user');
    Route::get('system/getDataInscricaoAdvogadoById/{id}', 'Controllers\SystemController@getDataInscricaoAdvogadoById');
    Route::get('system/getAdvogadoById/{id}', 'Controllers\SystemController@getAdvogadoById');
    Route::get('system/getHistoricoProcesso/{id}', 'Controllers\SystemController@getHistoricoProcesso');
    Route::get('system/getPatronoById/{id}', 'Controllers\SystemController@getPatronoById');
    Route::get('system/getEstagiariosPatrono/{id}', 'Controllers\SystemController@getEstagiariosPatrono');
    Route::get('system/getLinhaEstagiariosPatrono/{id}', 'Controllers\SystemController@getLinhaEstagiariosPatrono');

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

                Route::get('/assistance/list/{tipo}', 'Livewire\Admin\Listarassistencia')->name('list_assistencia');
                Route::get('/details/process/{hash}', 'Livewire\Secretaria\Detalhesregisto')->name('detalhes_registo');
                Route::get('/set/lawyer/{hash}', 'Livewire\Admin\Atribuiradvogado')->name('atribuir_advogado');

                Route::get('/new/user', 'Livewire\Admin\Cadastrarusuario')->name('new_user');
                Route::get('/users/list', 'Livewire\Admin\Listarusuario')->name('listusuario');
                Route::get('/users/members', 'Livewire\Admin\Listarassociados')->name('listassociados');
                Route::get('/users/edit/{id}', 'Livewire\Admin\Editarusuario')->name('edit_user');
                Route::get('/users/details/{id}', 'Livewire\Admin\Detalhesusuario')->name('detalhes_user');

                Route::get('/list/process', 'Livewire\Secretaria\Listarregistos')->name('listar_registos');

                Route::get('/export-undefined', 'Controllers\AdvogadoController@export_undefined')->name('export_undefined');
                Route::get('/export-lawyers', 'Controllers\AdvogadoController@export_lawyers')->name('export_lawyers');
                Route::get('/export-trainees', 'Controllers\AdvogadoController@export_trainees')->name('export_trainees');
                Route::get('/generate/report', 'Livewire\Secretaria\Gerarrelatorio')->name('generate_report');

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
                Route::get('/new/request-intervention', 'Livewire\Secretaria\Pedidointervencaocadastrar')->name('registar_pedido_intervencao');
                Route::get('/list/request-intervention', 'Livewire\Secretaria\Pedidointervencaolistar')->name('pedido_intervencao_listar');
                Route::get('/edit/process/{hash}', 'Livewire\Secretaria\Editarregisto')->name('editar_registo');
                Route::get('/list/process', 'Livewire\Secretaria\Listarregistos')->name('listar_registos');
                Route::get('/details/process/{hash}', 'Livewire\Secretaria\Detalhesregisto')->name('detalhes_registo');
                Route::get('/complaints/list/{tipo}', 'Livewire\Admin\Listardenuncias')->name('listdenuncias');
                Route::get('/generate/report', 'Livewire\Secretaria\Gerarrelatorio')->name('generate_report');
                Route::get('/document/assistance/{hash}', 'Livewire\Secretaria\Documentoassistencia')->name('documento_assistencia');

            });
        });

        Route::group(['middleware' => 'recepcionista'], function () {
            Route::prefix('recepcionista')->name('recepcionista.')->group(function () {

                Route::get('/', function () {
                    return redirect('/system/Secretaria/dashboard');
                });

                Route::get('/dashboard', 'Livewire\Secretaria\Dashboard')->name('dashboard');
                Route::get('/list/process', 'Livewire\Secretaria\Listarregistos')->name('listar_registos');
                Route::get('/details/process/{hash}', 'Livewire\Secretaria\Detalhesregisto')->name('detalhes_registo');
                Route::get('/list/trainees', 'Livewire\Admin\Listarestagiarios')->name('list_trainees');
                Route::get('/list/lawyers', 'Livewire\Admin\Listaradvogados')->name('list_lawyers');

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
                Route::get('/list/subscription', 'Livewire\Areatecnica\Advpendentes')->name('listar_advogados_pendentes');
                Route::get('/list/subscription-trainee', 'Livewire\Areatecnica\Advestpendentes')->name('listar_estagiarios_pendentes');
                Route::get('/list/subscription/registed/{categoria}', 'Livewire\Areatecnica\Advregistados')->name('listar_advogados_registados');
                Route::get('/list/lawyers-cn', 'Livewire\Areatecnica\Listacn')->name('listar_advogados_cn');
                Route::get('/list/map-distribution/{categoria}', 'Livewire\Areatecnica\Mapadistribuicao')->name('listar_mapa_distribuicao');
                Route::get('/list/subscription-trainee/registed/{categoria}', 'Livewire\Areatecnica\Advestregistados')->name('listar_estagiarios_registados');
                Route::get('/list/responsed', 'Livewire\Areatecnica\Ajdeferidos')->name('listar_pedidos_deferidos');
                Route::get('/list/assistance/archived', 'Livewire\Areatecnica\Ajarquivados')->name('listar_pedidos_arquivados');
                Route::get('/details/process/{hash}', 'Livewire\Secretaria\Detalhesregisto')->name('detalhes_registo');
                Route::get('/archive/assistance/{hash}', 'Livewire\Areatecnica\Arquivarpedido')->name('arquivar_pedido');
                Route::get('/regist/subscription/{hash}', 'Livewire\Areatecnica\Registarinscricao')->name('registar_inscricao');
                Route::get('/edit/subscription/{hash}', 'Livewire\Areatecnica\Editarinscricao')->name('editar_inscricao');
                Route::get('/regist/despacho/{hash}', 'Livewire\Areatecnica\Registardespacho')->name('registar_despacho');
                Route::get('/documento/despacho-indeferido/{hash}', 'Controllers\SystemController@documento_despacho')->name('documento_despacho');

                Route::get('/list/trainees', 'Livewire\Admin\Listarestagiarios')->name('list_trainees');
                Route::get('/list/cerimonia/{categoria}', 'Livewire\Admin\Listacerimonia')->name('list_cerimonia');
                Route::get('/list/lawyers', 'Livewire\Admin\Listaradvogados')->name('list_lawyers');
                Route::get('/list/patronos', 'Livewire\Areatecnica\Listarpatronos')->name('list_patronos');
                Route::get('/register/lawyer', 'Livewire\Areatecnica\Registarassociado')->name('regist_lawyer');
                Route::get('/list/subscription-trainee/remetidoscn', 'Livewire\Areatecnica\Advestremetidoscn')->name('list_est_remetidos_cn');
                Route::get('/edit-data/member/{hash}', 'Livewire\Areatecnica\Editarassociado')->name('edit_member');
                Route::get('/edit-data/patrono/{hash}', 'Livewire\Areatecnica\Editarpatrono')->name('edit_patrono');

                Route::get('/export-waiting/cerimony/{categoria}', 'Controllers\AdvogadoController@export_waiting_cerimony')->name('export_waiting_cerimony');
                Route::post('/exportxls-trainee/remessacn', 'Controllers\AdvogadoController@export_remessa_cn')->name('export_remessa_cn');
                Route::post('/exportxls-indicacao-patrono', 'Controllers\AdvogadoController@export_xls_indicacao_patrono');
                Route::get('/exportpdf-trainee/remessacn', 'Controllers\AdvogadoController@lista_estagiarios_remessacn')->name('exportpdf_remessa_cn');
                Route::post('/exportpdf-trainee-post/remessacn', 'Controllers\AdvogadoController@export_pdf_lista_estagiarios_remessacn');
                Route::post('/exportpdf-indicacao-patrono', 'Controllers\AdvogadoController@export_pdf_indicacao_patrono');
                Route::get('/exportpdf-waiting/cerimony/{categoria}', 'Controllers\AdvogadoController@lista_aguardando_cerimonia')->name('exportpdf_waiting_cerimony');

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
