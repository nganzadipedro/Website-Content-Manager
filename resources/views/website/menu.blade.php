<!-- MENU -->
<section class="section-menu">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm">
            <div class="container">

                <!-- Logo à esquerda -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/website/img/logo_oaa.png') }}" alt="Logo OAA" class="logo-navbar">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarMenu" aria-controls="navbarMenu" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Serviços</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('news') }}">Notícias</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('members') }}">Associados</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('comissions') }}">Comissões</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('legal_assistance') }}">Assistência Judiciária</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Galeria</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contactos</a></li>
                        <li class="nav-item"><a class="nav-link btn-signin" href="{{ route('login') }}">Área Reservada</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
</section>