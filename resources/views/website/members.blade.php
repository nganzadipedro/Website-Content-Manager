<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associados</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/members.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/members-responsive.css') }}">
</head>

<body class="members-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')


    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Associados CPL</h3>
                    <h4>Conheça os nossos associados</h4>
                </div>
            </div>
        </section>

        <!-- secção de estatística -->
        <section class="section-statistics">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <h3 class="title-section">Quantos somos?</h3>
                        <div class="card stats-card text-center p-4">
                            <div class="card-body">
                                <h3 class="card-title">Total de Associados</h3>
                                <span class="display-5 ">2397</span>
                            </div>
                        </div>
                        <div class="card stats-card text-center p-4">
                            <div class="card-body">
                                <h3 class="card-title">Homens</h3>
                                <span class="display-5 ">1205</span>
                            </div>
                        </div>
                        <div class="card stats-card text-center p-4">
                            <div class="card-body">
                                <h3 class="card-title">Mulheres</h3>
                                <span class="display-5 ">1098</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Seção 2: Como se tornar um membro -->
    <section class="members-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <div class="text-area">
                            <h4 class="section-title">Inscrições para Advogado(a) Estagiário(a)</h4>
                            <p class="mb-0 text-white">
                                Para se tornar um(a) advogado(a) estagiário(a), é necessário cumprir os seguintes
                                requisitos:
                            </p>
                            <div class="list-container">
                                <ul class="list-column section-one-list">
                                    <li>Ser admitido no Exame Nacional de Acesso à Advocacia;</li>
                                    <li>Requerimento ao Presidente do Conselho Provincial de Luanda/ Declaração de
                                        compatibilidade de funções. Art.º 4.º do EOAA;</li>
                                    <li>Boletim de inscrição assinado;</li>
                                    <li>Certificado de Licenciatura (Diploma) ou declaração com notas - cópia
                                        autenticada;</li>
                                    <li>Se for formado no exterior do país, deverá apresentar o certificado de
                                        licenciatura em direito autenticado pelos serviços consulares e uma declaração
                                        de reconhecimento dos estudos (cópia autenticada);</li>
                                    <li>Certificado de Registo Criminal;</li>
                                    <li>Fotocópia a cores do BI;</li>
                                    <li>3 Fotografias tipo passe, a cores;</li>
                                </ul>
                                <ul class="list-column section-one-list">
                                    <li>Atestado de residência;</li>
                                    <li>Declaração de serviço (se para além da advocacia exerce outra profissão; para
                                        quem não exerça deverá emitir declaração atestando esta condição);</li>
                                    <li>Fotocópia do NIF;</li>
                                    <li>Curriculum Vitae;</li>
                                    <li>Declaração do Patrono;</li>
                                    <li>Comprovativo de pagamento de taxas;</li>
                                </ul>
                            </div>
                            <div class="member-actions">
                                <a href="#" class="member-btn"><i class="bi bi-download"></i> Requerimento</a>
                                <a href="#" class="member-btn"><i class="bi bi-download"></i> Boletim de Inscrição</a>
                                <a href="#" class="member-btn">Inscrever-se pelo portal do CPL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção 3: Inscrições para Advogado(a) -->
    <section class="members-section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <div class="text-area">
                            <h4 class="section-title">Inscrições para Advogado(a)</h4>
                            <p class="mb-0">
                                Para se tornar um(a) advogado(a), é necessário cumprir os seguintes requisitos:
                            </p>
                            <div class="list-container">
                                <ul class="list-column">
                                    <li>Requerimento ao Presidente do Conselho Provincial de Luanda/ Declaração de
                                        compatibilidade de funções. Art.º 4.º do EOAA;</li>
                                    <li>Boletim de inscrição assinado;</li>
                                    <li>Certificado de Registo Criminal;</li>
                                    <li>Certificado do Centro de Estudos e Formação referente à conclusão, com
                                        aproveitamento da formação para Advogado Estagiário;</li>
                                    <li>Cédula de Advogado Estagiário - a ser entregue na data da Cerimónia de Entrega
                                        de Cédulas;</li>
                                    <li>Atestado de residência;</li>
                                    <li>Fotocópia do NIF;</li>
                                    <li>2 Fotografias tipo passe, a cores;</li>
                                </ul>
                                <ul class="list-column">
                                    <li>Certificado do reconhecimento ou equivalência dos estudos feitos no estrangeiro
                                        (original ou cópia autenticada);</li>
                                    <li>Declaração de serviço (se para além da advocacia exerce outra profissão; para
                                        quem não exerça deverá emitir declaração atestando esta condição);</li>
                                    <li>Relatório do patrono sobre a actividade exercida pelo estagiário com parecer
                                        fundamentado sobre a aptidão do estagiário para o exercício da profissão,
                                        incluindo o resumo das intervenções processuais;</li>
                                    <li>Processo completo (encadernado) com cópias dos articulados, cartas, actas de
                                        reuniões, requerimentos, alegações que produzir durante o período de estágio;
                                    </li>
                                    <li>Quinze (15) Intervenções processuais de natureza penal, sendo sete (7) em fase
                                        de instrução e oito (8) em fase de julgamento;</li>
                                    <li>Doze (12) processos em matéria não penal;</li>
                                    <li>Trabalho de dissertação sobre Ética e Deontologia Profissional, com um mínimo de
                                        quinze (15) páginas de desenvolvimento e contendo a opinião do patrono sobre o
                                        mesmo;</li>
                                    <li>Comprovativo de pagamento de taxas;</li>
                                </ul>
                            </div>
                            <div class="member-actions">
                                <a href="#" class="member-btn"><i class="bi bi-download"></i> Requerimento</a>
                                <a href="#" class="member-btn"><i class="bi bi-download"></i> Boletim de Inscrição</a>
                                <a href="#" class="member-btn">Inscrever-se pelo portal da OAA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção 4: Pesquisa de associados -->
    <section class="search-section">
        <div class="container text-center">
            <h3 class="section-title">Pesquisar Advogado</h3>
            <h4 class="subtitle">Encontre os advogados que fazem parte do conselho provincial de Luanda</h4>
            <form class="search-form">
                <div class="search-input-group">
                    <select id="search-select">
                        <option value="nome">Nome</option>
                        <option value="cedula">Cédula</option>
                        <option value="bi">Nº BI</option>
                    </select>
                    <input type="text" placeholder="Digite sua pesquisa">
                    <button type="submit">Pesquisar</button>
                </div>
            </form>
            <!-- <p class="none-result">
                Não foi encontrado nenhum registo na nossa base de dados.
            </p> -->

            <!-- <div class="search-results">
                <ul>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Ricardo Afonso da Fonseca</span>
                            <div>Email: ricardo.fonseca@email.com</div>
                            <div>Telefone: 923 456 789</div>
                        </div>
                        <div class="member-details">
                            <div>Cédula Patrono: 1234</div>
                            <div>Nome Patrono: António Manuel</div>
                        </div>
                        <span class="number-card">Cédula N.º 3768</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Maria Isabel dos Santos</span>
                            <div>Email: maria.santos@email.com</div>
                            <div>Telefone: 922 123 456</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: João Pereira</div>
                            <div>Cédula Patrono: 5678</div>
                        </div>
                        <span class="number-card">Cédula N.º 31268</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">João Manuel Pereira</span>
                            <div>Email: joao.pereira@email.com</div>
                            <div>Telefone: 921 987 654</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Ana Fernandes</div>
                            <div>Cédula Patrono: 9101</div>
                        </div>
                        <span class="number-card">Cédula N.º 28754</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Ana Paula Fernandes</span>
                            <div>Email: ana.fernandes@email.com</div>
                            <div>Telefone: 924 111 222</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Manuel Jorge</div>
                            <div>Cédula Patrono: 2345</div>
                        </div>
                        <span class="number-card">Cédula N.º 19876</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Carlos Alberto Lima</span>
                            <div>Email: carlos.lima@email.com</div>
                            <div>Telefone: 925 222 333</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Sofia Mendes</div>
                            <div>Cédula Patrono: 3456</div>
                        </div>
                        <span class="number-card">Cédula N.º 15432</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Helena Cristina Lopes</span>
                            <div>Email: helena.lopes@email.com</div>
                            <div>Telefone: 926 333 444</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Pedro Silva</div>
                            <div>Cédula Patrono: 4567</div>
                        </div>
                        <span class="number-card">Cédula N.º 17654</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Pedro António Silva</span>
                            <div>Email: pedro.silva@email.com</div>
                            <div>Telefone: 927 444 555</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Helena Costa</div>
                            <div>Cédula Patrono: 5678</div>
                        </div>
                        <span class="number-card">Cédula N.º 22345</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Sofia Margarida Costa</span>
                            <div>Email: sofia.costa@email.com</div>
                            <div>Telefone: 928 555 666</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Miguel Rocha</div>
                            <div>Cédula Patrono: 6789</div>
                        </div>
                        <span class="number-card">Cédula N.º 26543</span>
                    </li>
                    <li>
                        <div class="member-info">
                            <span class="member-name">Miguel Domingos Rocha</span>
                            <div>Email: miguel.rocha@email.com</div>
                            <div>Telefone: 929 666 777</div>
                        </div>
                        <div class="member-details">
                            <div>Nome Patrono: Ana Paula</div>
                            <div>Cédula Patrono: 7890</div>
                        </div>
                        <span class="number-card">Cédula N.º 31290</span>
                    </li>
                </ul>
            </div> -->

            <div class="search-links">
                <a href="#" class="updated-list">Ver lista actualizada dos Advogados</a>
                <a href="#" class="updated-list">Ver lista actualizada dos Advogados estagiários</a>
            </div>
        </div>
    </section>

    @include('website.footer')

    <script src="{{ asset('assets/website/js/members.js') }}"></script>

</body>

</html>