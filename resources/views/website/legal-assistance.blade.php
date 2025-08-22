<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistência Judiciária</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/legal-assistance.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/complaints.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/responsive-complaints.css') }}">
</head>

<body class="main-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')

    <div class="container">


        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Assistência Judiciária CPL</h3>
                    <h4>Tenha acesso a lei</h4>
                </div>
            </div>
        </section>

    </div>

    <!-- Seção: Sobre Assistência Judiciária -->
    <section class="legal-assistance-info">
        <div class="container">
            <h2 class="section-title">O que é Assistência Judiciária?</h2>
            <p>
                A assistência judiciária, também chamada de assistência jurídica, é um direito previsto na Constituição
                que garante que pessoas comprovadamente pobres possam ter acesso à justiça, mesmo sem condições de arcar
                com as custas, despesas judiciais e honorários de advogados. Este sistema visa assegurar que a falta de
                recursos financeiros não impeça o exercício do direito de defesa e acesso à justiça.
            </p>
            <h3 class="subtitle">Como beneficiar da assistência judiciária?</h3>
            <p>
                O cidadão deve comprovar sua insuficiência econômica, geralmente mediante a apresentação de um atestado
                de pobreza, preencher o formulário de assistência judiciária junto do Conselho Provincial de Luanda da
                Ordem dos Advogados de Angola, juntar cópia do Bilhete de Identidade do Beneficiário e outros documentos
                que se achar necessário.
            </p>
        </div>
    </section>

    <div class="container">

        <section class="section-complaints">
            <div class="row">
                <div class="col-12">
                    <h4 class="title">Como Fazer Denúncias e Reclamações?</h4>
                    <p class="description">
                        As reclamações ou participações são feitas mediante a apresentação de um requerimento dirigido
                        ao Conselho Provincial de Luanda da Ordem dos Advogados de Angola (OAA) ou ao seu Presidente. O
                        requerimento deve ser entregue na receção do Conselho, sendo posteriormente encaminhado à
                        Secretaria para registo e remessa à Sala do Presidente para os devidos efeitos.
                    </p>
                </div>
            </div>
        </section>

    </div>

    <section class="section-complaint-form">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="form-title">Formulário de Denúncias e Reclamações</h3>
                    <form id="complaintForm" action="#" method="post">
                        <div class="row col-12">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Digite seu nome completo" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="subject" class="form-label">Assunto</label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    placeholder="Digite o assunto da denúncia/reclamação" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="message" name="message" rows="6"
                                placeholder="Descreva sua denúncia ou reclamação" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Anexar Arquivo</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('website.footer')


</body>

<script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/website/js/index.js') }}"></script>
<script src="{{ asset('assets/website/js/legal-assistance-animations.js') }}"></script>

</html>