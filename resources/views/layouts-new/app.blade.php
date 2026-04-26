<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema de Gestão de Informações - CPL OAA</title>

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

    @include('layouts-new.header')

    @include('layouts-new.sidebar')


    @yield('content')


  </div>

  @livewireScripts

  @include('layouts-new.footer-assets')

</body>

</html>