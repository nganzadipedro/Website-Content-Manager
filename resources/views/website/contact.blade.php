<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/contact-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
</head>

<body class="contact-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')


    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Contactos CPL</h3>
                    <h4>Temos uma equipa disponível para atendé-lo</h4>
                </div>
            </div>
        </section>

        <section class="section-contact">
            <!-- Informações de Contacto (3 colunas horizontais) -->
            <div class="row contact-info-row mb-5">
                <div class="col-md-4 col-sm-12 text-center">
                    <div class="contact-item">
                        <i class="bi bi-geo-alt contact-icon"></i>
                        <h4 class="contact-title">Sede</h4>
                        <p class="contact-text">Distrito Urbano da Maianga, Largo João Seca, Casa n.º 6, Luanda, Angola
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 text-center">
                    <div class="contact-item d-flex flex-column">
                        <i class="bi bi-envelope contact-icon"></i>
                        <h4 class="contact-title">Endereço de e-mail</h4>
                        <p class="contact-text"><a href="mailto:contacto@cpl.oaa.org">secretaria@cpl-oaang2.org</a></p>
                        <p class="contact-text"><a href="mailto:contacto@cpl.oaa.org">geral@cpl-oaang2.org</a></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 text-center">
                    <div class="contact-item d-flex flex-column text-center">
                        <i class="bi bi-telephone contact-icon"></i>
                        <h4 class="contact-title">Número de Telefone</h4>
                        <p class="contact-text text-center">+244 928 410 082</p>
                        <p class="contact-text text-center">+244 921 148 148</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="section-map-form">
        <div class="container">
            <!-- Formulário e Mapa -->
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h2 class="contact-title-main">Envie-nos uma mensagem</h2>
                    <div class="contact-form">
                        <form id="contactForm">
                            <div class="mb-3 position-relative">
                                <label for="name" class="form-label">Seu nome</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="email" class="form-label">Seu e-mail</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="subject" class="form-label">Assunto</label>
                                <input type="text" class="form-control" id="subject" required>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="senderType" class="form-label">Tipo de Remetente</label>
                                <select class="form-control" id="senderType" required>
                                    <option value="">Selecione</option>
                                    <option value="advogado">Advogado</option>
                                    <option value="particular">Particular</option>
                                </select>
                            </div>
                            <div class="mb-3 position-relative identification-field" style="display: none;">
                                <label for="identification" class="form-label" id="identificationLabel">Número de
                                    Identificação</label>
                                <input type="text" class="form-control" id="identification">
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="message" class="form-label">Sua mensagem</label>
                                <textarea class="form-control" id="message" rows="5" required></textarea>
                            </div>
                            <div class="text-start">
                                <button type="submit" class="btn btn-signin">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="contact-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.983108205404!2d13.246832375873927!3d-8.822512891392174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51e9a8e0a5d7f3%3A0x9c2b2b2b2b2b2b2b!2sLuanda%2C%20Angola!5e0!3m2!1sen!2sao!4v1623456789012!5m2!1sen!2sao"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/contact.js') }}"></script>

</body>

</html>