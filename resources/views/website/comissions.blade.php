<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comissões</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/comissions.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/commission-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/commissions-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/commission-ethics.css') }}">
</head>

<body class="main-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}"" alt="">
    </section>

    @include('website.menu')

    <div class="container">

        <div class="commissions-header">
            <h3 class="commissions-title">Comissões do Conselho Provincial de Luanda</h3>
            <h4 class="commissions-subtitle">
                Conheça as principais comissões e seus membros dentro do Conselho Provincial de Luanda.
            </h4>
        </div>

    </div>

    <!-- Comissão de Combate ao Exercício Ilegal da Profissão -->
    <section class="commission">
        <div class="container">
            <h2>Comissão de Combate ao Exercício Ilegal da Profissão</h2>
            <div class="commissions-slider" id="commission-illegal-practice-slider">
                <div class="slider-container">
                    <div class="slider-track">
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/emery_moio.jpg') }}"
                                alt="Emery Moio Kudissadila">
                            <p>Emery Moio Kudissadila</p>
                            <span class="card-number">Cédula Nº 2702</span>
                            <span class="role">Coordenador</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/belchior_catongo.jpg') }}"
                                alt="Belchior Fidel Catongo">
                            <p>Belchior Fidel Catongo</p>
                            <span class="card-number">Cédula Nº 1716</span>
                            <span class="role">Coordenador-Adjunto</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/antonio_soma.jpg') }}"
                                alt="António Cahamba Soma">
                            <p>António Cahamba Soma</p>
                            <span class="card-number">Cédula Nº 4784</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Basílio Kambya">
                            <p>Basílio Kambya</p>
                            <span class="card-number">Cédula Nº 2025</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/ema_joao.jpg') }}"
                                alt="Ema Marlene Nunes João">
                            <p>Ema Marlene Nunes João</p>
                            <span class="card-number">Cédula Nº 6092</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/nelson_cahunda.jpg') }}"
                                alt="Nelson Morais Cahunda">
                            <p>Nelson Morais Cahunda</p>
                            <span class="card-number">Cédula Nº 3033</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/santana_francisco.jpg') }}"
                                alt="Santana Manuel Francisco">
                            <p>Santana Manuel Francisco</p>
                            <span class="card-number">Cédula Nº 2005</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_exercicio_ilegal/sara_ramos.jpg') }}"
                                alt="Sara Patrícia Da Rocha Ramos Da Cruz">
                            <p>Sara Patrícia Da Rocha Ramos Da Cruz</p>
                            <span class="card-number">Cédula Nº 6068</span>
                            <span class="role">Comissária</span>
                        </div>
                    </div>
                </div>
                <div class="slider-dots"></div>
            </div>
        </div>
    </section>

    <!-- Comissão de Acesso e Acompanhamento de Estágio -->
    <section class="commission commision-background">
        <div class="container">
            <h2>Comissão de Acesso e Acompanhamento de Estágio</h2>
            <div class="commissions-slider" id="commission-internship-slider">
                <div class="slider-container">
                    <div class="slider-track">
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/aline_simoes.jpg') }}"
                                alt="Aline Maura Da Cruz Simões">
                            <p>Aline Maura Da Cruz Simões</p>
                            <span class="card-number">Cédula Nº 2379</span>
                            <span class="role">Coordenadora</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/edna_vandunem.jpg') }}"
                                alt="Edna José Van-Dúnem">
                            <p>Edna José Van-Dúnem</p>
                            <span class="card-number">Cédula Nº 4345</span>
                            <span class="role">Coordenadora-Adjunta</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/agostinho_paulo.jpg') }}"
                                alt="Agostinho Da Conceição Paulo">
                            <p>Agostinho Da Conceição Paulo</p>
                            <span class="card-number">Cédula Nº 2999</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/emilio_santos.jpg') }}"
                                alt="Emílio Willian António Dos Santos">
                            <p>Emílio Willian António Dos Santos</p>
                            <span class="card-number">Cédula Nº 2281</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/gomes_dos_santos.jpg') }}"
                                alt="Gomes Mateus Dos Santos">
                            <p>Gomes Mateus Dos Santos</p>
                            <span class="card-number">Cédula Nº 4157</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/adelina_mabiala.jpg') }}"
                                alt="Adelina Makunga Mabiala">
                            <p>Adelina Makunga Mabiala</p>
                            <span class="card-number">Cédula Nº 5788</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Cláudio Fernandes Nascimento Gonçalves">
                            <p>Cláudio Fernandes Nascimento Gonçalves</p>
                            <span class="card-number">Cédula Nº 5880</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Domingas Maria Quicuambi José Bravo">
                            <p>Domingas Maria Quicuambi José Bravo</p>
                            <span class="card-number">Cédula Nº 2857</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/helder_francisco.jpg') }}"
                                alt="Hélder Sérgio Francisco">
                            <p>Hélder Sérgio Francisco</p>
                            <span class="card-number">Cédula Nº 5606</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/ivone_mateus.jpg') }}"
                                alt="Ivone Sofia Comprido Mateus">
                            <p>Ivone Sofia Comprido Mateus</p>
                            <span class="card-number">Cédula Nº 5990</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/jorge_santa.jpg') }}"
                                alt="Jorge Santa Pedro Rodrigues">
                            <p>Jorge Santa Pedro Rodrigues</p>
                            <span class="card-number">Cédula Nº 6681</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/manuel_duarte.jpg') }}"
                                alt="Manuel João Falcão De Brito Duarte">
                            <p>Manuel João Falcão De Brito Duarte</p>
                            <span class="card-number">Cédula Nº 3960</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_acompanhamento/rossiane_pascoal.jpg') }}"
                                alt="Rosianne Pávla Cardoso Pascoal">
                            <p>Rosianne Pávla Cardoso Pascoal</p>
                            <span class="card-number">Cédula Nº 5714</span>
                            <span class="role">Comissária</span>
                        </div>
                    </div>
                </div>
                <div class="slider-dots"></div>
            </div>
        </div>
    </section>

    <!-- Comissão de Garantias e Prerrogativas dos Advogados -->
    <section class="commission">
        <div class="container">
            <h2>Comissão de Garantias e Prerrogativas dos Advogados</h2>
            <div class="commissions-slider" id="commission-guarantees-slider">
                <div class="slider-container">
                    <div class="slider-track">
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_prerrogativas/edgar_cassanje.jpg') }}"
                                alt="Edgar Inácio Cassange">
                            <p>Edgar Inácio Cassange</p>
                            <span class="card-number">Cédula Nº 1650</span>
                            <span class="role">Coordenador</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_prerrogativas/dilson_barros.jpg') }}"
                                alt="Dilson Esmael De Fátima Barros">
                            <p>Dilson Esmael De Fátima Barros</p>
                            <span class="card-number">Cédula Nº 1575</span>
                            <span class="role">Coordenador-Adjunto</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_prerrogativas/samuel_pedro.jpg') }}" alt="Samuel Pedro">
                            <p>Samuel Pedro</p>
                            <span class="card-number">Cédula Nº 4661</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Edmundo Miguel António">
                            <p>Edmundo Miguel António</p>
                            <span class="card-number">Cédula Nº 1130</span>
                            <span class="role">Comissário</span>
                        </div>
                    </div>
                </div>
                <div class="slider-dots"></div>
            </div>
        </div>
    </section>

    <!-- Comissão de Ética e Deontologia -->
    <section class="commission commision-background">
        <div class="container">
            <h2>Comissão de Ética e Deontologia</h2>
            <div class="commission-members-grid" id="commission-ethics-grid">
                <div class="member-row">
                    <div class="ethics-member">
                        <img src="{{ asset('assets/website/img/fotos/comissao_etica/dilson_barros.jpg') }}"
                            alt="Dilson Esmael De Fátima Barros">
                        <p>Dilson Esmael De Fátima Barros</p>
                        <span class="card-number">Cédula Nº 1575</span>
                        <span class="role">Coordenador</span>
                    </div>
                    <div class="ethics-member">
                        <img src="{{ asset('assets/website/img/fotos/comissao_etica/edgar_cassanje.jpg') }}" alt="Edgar Inácio Cassange">
                        <p>Edgar Inácio Cassange</p>
                        <span class="card-number">Cédula Nº 1650</span>
                        <span class="role">Coordenador-Adjunto</span>
                    </div>
                    <div class="ethics-member">
                        <img src="{{ asset('assets/website/img/fotos/comissao_etica/cintia_gourgel.jpg') }}"
                            alt="Cintia Ousanarah Costa Do Amaral Gourgel">
                        <p>Cintia Ousanarah Costa Do Amaral Gourgel</p>
                        <span class="card-number">Cédula Nº 1235</span>
                        <span class="role">Comissária</span>
                    </div>
                </div>
                <div class="member-row">
                    <div class="ethics-member">
                        <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Dorivaldo João Americano Da Costa">
                        <p>Dorivaldo João Americano Da Costa</p>
                        <span class="card-number">Cédula Nº 2196</span>
                        <span class="role">Comissário</span>
                    </div>
                    <div class="ethics-member">
                        <img src="{{ asset('assets/website/img/fotos/comissao_etica/jandira_andre.jpg') }}"
                            alt="Jandira Cláudia Baptista Paulo André">
                        <p>Jandira Cláudia Baptista Paulo André</p>
                        <span class="card-number">Cédula Nº 1245</span>
                        <span class="role">Comissária</span>
                    </div>
                    <div class="ethics-member">
                        <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Marcelino Patrício Victor Da Silva">
                        <p>Marcelino Patrício Victor Da Silva</p>
                        <span class="card-number">Cédula Nº 1657</span>
                        <span class="role">Comissário</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comissão de Direitos Humanos e Cidadania -->
    <section class="commission">
        <div class="container">
            <h2>Comissão de Direitos Humanos e Cidadania</h2>
            <div class="commissions-slider" id="commission-human-rights-slider">
                <div class="slider-container">
                    <div class="slider-track">
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Daniel Hossi Tchitumba Daniel">
                            <p>Daniel Hossi Tchitumba Daniel</p>
                            <span class="card-number">Cédula Nº 3149</span>
                            <span class="role">Coordenador</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_direitos_humanos/mauro_albuquerque.jpg') }}"
                                alt="Mauro Ezer Reais Alburquerque">
                            <p>Mauro Ezer Reais Alburquerque</p>
                            <span class="card-number">Cédula Nº 3410</span>
                            <span class="role">Coordenador-Adjunto</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_direitos_humanos/agostinho_paulo.jpg') }}"
                                alt="Agostinho Da Conceição Paulo">
                            <p>Agostinho Da Conceição Paulo</p>
                            <span class="card-number">Cédula Nº 2999</span>
                            <span class="role">Coordenador-Adjunto</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Adilson Ferreira Rangel">
                            <p>Adilson Ferreira Rangel</p>
                            <span class="card-number">Cédula Nº 2998</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Alberto Namumo Avelino Tchitundo">
                            <p>Alberto Namumo Avelino Tchitundo</p>
                            <span class="card-number">Cédula Nº 3405</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="António Pedro Caxala">
                            <p>António Pedro Caxala</p>
                            <span class="card-number">Cédula Nº 1401</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Belmiro Tomás Engenheiro Pinto">
                            <p>Belmiro Tomás Engenheiro Pinto</p>
                            <span class="card-number">Cédula Nº 3091</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_direitos_humanos/domingos_mateus.jpg') }}"
                                alt="Domingos Chipilica Mateus">
                            <p>Domingos Chipilica Mateus</p>
                            <span class="card-number">Cédula Nº 2829</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Figueiredo Francisco Dala">
                            <p>Figueiredo Francisco Dala</p>
                            <span class="card-number">Cédula Nº 3353</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Jesus Pestana De Lemos">
                            <p>Jesus Pestana De Lemos</p>
                            <span class="card-number">Cédula Nº 5825</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="João Moisés Tchitombe Capitango">
                            <p>João Moisés Tchitombe Capitango</p>
                            <span class="card-number">Cédula Nº 3692</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Khrys Damar Do Nascimento">
                            <p>Khrys Damar Do Nascimento</p>
                            <span class="card-number">Cédula Nº 4769</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Laurindo Fonseca Sahana">
                            <p>Laurindo Fonseca Sahana</p>
                            <span class="card-number">Cédula Nº 4068</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Lázaro Manuel Jaime">
                            <p>Lázaro Manuel Jaime</p>
                            <span class="card-number">Cédula Nº 7504</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Lesley De Assunção Agostinho">
                            <p>Lesley De Assunção Agostinho</p>
                            <span class="card-number">Cédula Nº 9223</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Martinho Manuel Luiba">
                            <p>Martinho Manuel Luiba</p>
                            <span class="card-number">Cédula Nº 7424</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Mirella Vânia Leitão Dos Santos">
                            <p>Mirella Vânia Leitão Dos Santos</p>
                            <span class="card-number">Cédula Nº 4943</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Ozan Aulânio Reais Albuquerque">
                            <p>Ozan Aulânio Reais Albuquerque</p>
                            <span class="card-number">Cédula Nº 6051</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Paulo De Jesus Futi Quimbi">
                            <p>Paulo De Jesus Futi Quimbi</p>
                            <span class="card-number">Cédula Nº 5260</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Roque António Gomes Umbar">
                            <p>Roque António Gomes Umbar</p>
                            <span class="card-number">Cédula Nº 3734</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/fotos/comissao_direitos_humanos/veronica_silva.jpg') }}"
                                alt="Veronice Eulália Da Silva">
                            <p>Veronice Eulália Da Silva</p>
                            <span class="card-number">Cédula Nº 7436</span>
                            <span class="role">Comissária</span>
                        </div>
                    </div>
                </div>
                <div class="slider-dots"></div>
            </div>
        </div>
    </section>

    <!-- Comissão de Comunicação e Imagem -->
    <section class="commission commision-background">
        <div class="container">
            <h2>Comissão de Comunicação e Imagem</h2>
            <div class="commissions-slider" id="commission-communication-slider">
                <div class="slider-container">
                    <div class="slider-track">
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Lezly Edith Orobio Da Silva Cardoso">
                            <p>Lezly Edith Orobio Da Silva Cardoso</p>
                            <span class="card-number">Cédula Nº 2914</span>
                            <span class="role">Coordenadora</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Gomes Mateus Dos Santos">
                            <p>Gomes Mateus Dos Santos</p>
                            <span class="card-number">Cédula Nº 4157</span>
                            <span class="role">Coordenador-Adjunto</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="José Rodrigues Vicente">
                            <p>José Rodrigues Vicente</p>
                            <span class="card-number">Cédula Nº 3213</span>
                            <span class="role">Coordenador-Adjunto</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Bassão Joana José">
                            <p>Bassão Joana José</p>
                            <span class="card-number">Cédula Nº 5248</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="José Morais Soladi">
                            <p>José Morais Soladi</p>
                            <span class="card-number">Cédula Nº 5478</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Mavacala Domingos João">
                            <p>Mavacala Domingos João</p>
                            <span class="card-number">Cédula Nº 3457</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Hermenegildo Fernando João Francisco">
                            <p>Hermenegildo Fernando João Francisco</p>
                            <span class="card-number">Cédula Nº 3477</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="César Teixeira Samuel">
                            <p>César Teixeira Samuel</p>
                            <span class="card-number">Cédula Nº 6668</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Rafael Brás Ndumba">
                            <p>Rafael Brás Ndumba</p>
                            <span class="card-number">Cédula Nº 5895</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Adelino Laurindo Alberto">
                            <p>Adelino Laurindo Alberto</p>
                            <span class="card-number">Cédula Nº 1691</span>
                            <span class="role">Comissário</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Lucélia Fernanda Franque Ribeiro Guimarães">
                            <p>Lucélia Fernanda Franque Ribeiro Guimarães</p>
                            <span class="card-number">Cédula Nº 4462</span>
                            <span class="role">Comissária</span>
                        </div>
                        <div class="commission-member">
                            <img src="{{ asset('assets/website/img/nilton_praia.webp') }}" alt="Núria Edna Dos Santos Domingos">
                            <p>Núria Edna Dos Santos Domingos</p>
                            <span class="card-number">Cédula Nº 6779</span>
                            <span class="role">Comissária</span>
                        </div>
                    </div>
                </div>
                <div class="slider-dots"></div>
            </div>
        </div>
    </section>


    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/index.js') }}"></script>
    <script src="{{ asset('assets/website/js/commission-animation.js') }}"></script>
    <!-- Scripts de slider para cada section de comissão -->
    <script src="{{ asset('assets/website/js/commissions-slider.js') }}"></script>
    <script src="{{ asset('assets/website/js/commissions-internship-slider.js') }}"></script>
    <script src="{{ asset('assets/website/js/commissions-guarantees-slider.js') }}"></script>
    <script src="{{ asset('assets/website/js/commissions-ethics-slider.js') }}"></script>
    <script src="{{ asset('assets/website/js/commissions-human-rights-slider.js') }}"></script>
    <script src="{{ asset('assets/website/js/commissions-communication-slider.js') }}"></script>
</body>

</html>