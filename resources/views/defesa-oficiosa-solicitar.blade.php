<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Defesas Oficiosas - CPL OAA</title>
  <!-- CSS files -->
  <link href="{{ asset('assets/new-template/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
  <link href="{{ asset('assets/new-template/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
  <link href="{{ asset('assets/new-template/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
  <link href="{{ asset('assets/new-template/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
  <link href="{{ asset('assets/new-template/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <link rel="stylesheet" href="{{ asset('assets/system/css/libs/sweetalert2/sweetalert2.min.css') }}">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <!--datatable responsive css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  @yield('css-aux')

  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>

  @livewireStyles
</head>

<body>
  <script src="{{ asset('assets/new-template/dist/js/demo-theme.min.js?1692870487') }}" defer></script>
  <div class="page">
    <!-- Navbar -->

    <div class="page-wrapper">

      <!-- Page header -->
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="card">
            <div class="card-body">
              <div class="row text-center">
                <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                  <img src="{{ asset('images/logo_oaa_cor.png') }}" width="110" height="110" alt="">
                  <h3 class="mt-3 text-center">Conselho Provincial de Luanda da Ordem
                    dos Advogados de Angola
                  </h3>
                  <h3 class="mt-3 text-center">Formulário de Solicitação de Defesa Oficiosa
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">

          <div class="card">
            <div class="card-body">

              <input type="hidden" name="advogado_id" id="advogado_id" value="">

              <div class="row">

                <div class="col-md-4 col-lg-4 col-12 col-xs-12">
                  <label for="tipo_pesquisa" class="form-label">Pesquisar por</label>
                  <select name="tipo_pesquisa" id="tipo_pesquisa" class="form-control">
                    <option value="bilhete" selected>Nº Bilhete</option>
                    <option value="cedula">Nº Cédula</option>
                  </select>
                </div>
                <div class="col-md-4 col-lg-4 col-12 col-xs-12">
                  <label class="form-label" for="num_verificar" id="lbl_num_verificar">Nº Bilhete</label>
                  <input type="text" maxlength="14" class="form-control" name="num_verificar" id="num_verificar"
                    value="" placeholder="Digite o nº do bilhete">
                </div>
                <div class="col-md-4 col-lg-4 col-12 col-xs-12">
                  <label for="categoria" class="form-label">Categoria</label>
                  <select name="categoria_verificar" id="categoria_verificar" class="form-control">
                    <option value="" selected>Selecione...</option>
                    <option value="Advogado">Advogado</option>
                    <option value="Estagiario">Estagiario</option>
                  </select>
                </div>

              </div>

              <div class="row mt-5">
                <div class="col-md-12 col-lg-12 col-12 col-xs-12 text-center">
                  <a id="btn-verificar" class="btn btn-primary">Verificar Dados</a>
                </div>
              </div>

              <div class="mt-5" id="campos-finais" style="border: solid 1px #ccc; padding: 15px; border-radius: 5px;">

                <p id="pg-sucesso" class="alert alert-success text-center">Encontramos o seu registo na base de dados.
                  Em caso de haver alguma irregularidade, solicite actualização de dados junto a secretaria do CPL.<br>
                  Preencha os outros campos em falta no formulário para submeter a sua solicitação:</p>
                <p id="pg-aviso" class="alert alert-warning text-center">Não encontramos o seu registo na nossa base de
                  dados. Preencha o formulário que se segue:</p>

                <div class="row mt-5">
                  <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                    <label class="form-label">Nome completo (sem abreviações)</label>
                    <input type="text" placeholder="Digite o seu nome completo" maxlength="150" class="form-control"
                      name="nome_completo" id="nome_completo">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                    <label class="form-label">Nº Bilhete</label>
                    <input type="text" maxlength="15" placeholder="Digite o número do bilhete" class="form-control"
                      name="num_bilhete" id="num_bilhete">
                  </div>

                  <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                    <label for="genero" class="form-label">Género</label>
                    <select name="genero" id="genero" class="form-control">
                      <option value="" selected>Selecione...</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                    <label class="form-label">Nº Cédula</label>
                    <input type="text" maxlength="10" placeholder="Digite o número da cédula"
                      oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" name="num_cedula"
                      id="num_cedula">
                  </div>
                  <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                    <label class="form-label">Categoria</label>
                    <input type="text" maxlength="10" placeholder="Digite o número da cédula" class="form-control"
                      name="categoria" id="categoria">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" maxlength="150" placeholder="Digite o seu email" class="form-control"
                      name="email" id="email">
                  </div>

                  <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                    <label class="form-label" for="telefone1">Telefone principal</label>
                    <input type="text" maxlength="9" placeholder="9xxxxxxxx" class="form-control" name="telefone1"
                      id="telefone1">
                  </div>
                  <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                    <label class="form-label" for="telefone2">Telefone alternativo</label>
                    <input type="text" maxlength="9" class="form-control" placeholder="9xxxxxxxx" name="telefone2"
                      id="telefone2">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                    <label class="form-label">Nome do Escritório</label>
                    <input type="text" maxlength="200" placeholder="Digite o nome do escritório" class="form-control"
                      name="nome_escritorio" id="nome_escritorio">
                  </div>
                  <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                    <label class="form-label">Endereço do Escritório/Profissional</label>
                    <input type="text" maxlength="200"
                      placeholder="Informe o endereço do escritório/endereço profissional" class="form-control"
                      name="endereco_escritorio" id="endereco_escritorio">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                    <label for="municipio_id" class="form-label">Município (referente ao Escritório/Endereço
                      Profissional)</label>
                    <select name="municipio_id" id="municipio_id" class="form-control">
                      <option value="" selected>Selecione...</option>
                      @foreach ($municipios as $mun)
                        <option value="{{$mun->id}}">{{$mun->descricao}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                    <label for="tipo_processo" class="form-label">Tipos de Processo a Intervir</label>
                    <input type="text" maxlength="200" class="form-control" name="tipo_processo" id="tipo_processo"
                      value="" placeholder="Civil, Penal, Laboral">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                    <label class="form-label">Documento de solicitação de defesa oficiosa</label>
                    <input type="file" class="form-control" name="documento" id="documento">
                  </div>
                </div>

                <div id="dados-patrono">

                  <div class="row mt-4">
                    <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                      <label class="form-label">Nome do Patrono</label>
                      <input type="text" maxlength="200" placeholder="Digite o nome do patrono" class="form-control"
                        name="nome_patrono" id="nome_patrono" value="">
                    </div>
                    <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                      <label class="form-label">Nº Cédula do patrono</label>
                      <input type="text" maxlength="10" placeholder="Informe o nº de cédula do patrono"
                        class="form-control" name="cedula_patrono" id="cedula_patrono">
                    </div>
                    <div class="col-md-3 col-lg-3 col-12 col-xs-12">
                      <label class="form-label">Telefone do patrono</label>
                      <input type="text" maxlength="9" placeholder="9xxxxxxxx" class="form-control"
                        name="telefone_patrono" id="telefone_patrono">
                    </div>
                  </div>

                  <div class="row mt-4">
                    <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                      <label class="form-label">Email do patrono</label>
                      <input type="email" maxlength="150" placeholder="Digite o email do patrono" class="form-control"
                        name="email_patrono" id="email_patrono">
                    </div>
                  </div>

                </div>

                <div class="row mt-5">
                  <div class="col-md-12 col-lg-12 col-12 col-xs-12 text-center">
                    <a href="btn-submeter" class="btn btn-success mt-2">Submeter Solicitação</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  </div>

  @livewireScripts

  @include('layouts-new.footer-assets')

  <script src="{{ asset('assets/system/js/defesa-oficiosa-solicitar.js') }}"></script>

</body>

</html>