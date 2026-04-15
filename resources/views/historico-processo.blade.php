<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Consultar Processo - CPL OAA</title>
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

    #preencher-formulario {
      text-decoration: underline;
      cursor: pointer;
      font-style: italic;
    }

     #preencher-formulario:hover {
      color: #000;
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
                  <h2 class="mt-3 text-center">Formulário de Consulta de Processos de Inscrição para Advogado e Advogado Estagiário
                  </h2>
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

              @csrf

              <div class="row">

                <div class="col-md-4 col-lg-4 col-12 col-xs-12">
                
                </div>
                <div class="col-md-4 col-lg-4 col-12 col-xs-12 text-center">
                  <label class="form-label" for="num_verificar">Nº Processo</label>
                  <input type="text" maxlength="14" class="form-control" name="num_verificar" id="num_verificar"
                    value="" placeholder="Digite o nº do processo">
                </div>
                <div class="col-md-4 col-lg-4 col-12 col-xs-12">
                  
                </div>

              </div>

              <div class="row mt-5">
                <div class="col-md-12 col-lg-12 col-12 col-xs-12 text-center">
                  <a id="btn-verificar" class="btn btn-primary">Verificar Processo</a>
                </div>
              </div>

              <div id="pg-aviso" class="alert alert-warning text-center mt-4">

                Não encontramos nenhum registo associado ao número do processo fornecido. Apresentamos-lhe a seguinte opção:<br><br>

                <p>
                  <strong>
                    1) Contactar a secretaria do CPL para obter mais informações sobre o seu processo.<br>
                  </strong>
                </p>

              </div>

              <div class="mt-5" id="campos-finais" style="border: solid 1px #ccc; padding: 15px; border-radius: 5px;">
             
                <div class="row mt-4">
                 
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

  <script src="{{ asset('assets/system/js/consultar-processo.js') }}"></script>

</body>

</html>