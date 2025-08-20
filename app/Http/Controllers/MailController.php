<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{

    public $sendgridApiKey = env('SENDGRID_API_KEY');

    public function mailValidacao($email, $nome, $codigo)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Validação de conta</h2>
        <hr>
        <p>
        Exmo(a). Senhor(a) $nome, <br><br><br>
        Segue abaixo o código de validação para confirmar a sua inscrição.<br><br>
        <strong>Código: </strong> $codigo <br>
        <hr>
        <p>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>       
        ";

        $dados_email = [
            "personalizations" => [
                [
                    "to" => [
                        [
                            "email" => $email,
                            "name" => $nome
                        ]
                    ],
                    "subject" => "CEF - Formações | CÓDIGO DE VALIDAÇÃO"
                ]
            ],
            "content" => [
                [
                    "type" => "text/html",
                    "value" => $mensagem
                ]
            ],
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "reply_to" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ]
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer " . $this->sendgridApiKey,
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailRegisto($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Bem-Vindo à Formação Inicial Obrigatória | 2025</h2>
        <hr>
        <p>
        Exmo(a). Senhor(a) $nome, <br><br><br>
        Informamos que o seu processo de inscrição para a Formação inicial Obrigatória foi submetido com sucesso e encontra-se pendente para 
        validação pelo Centro de Estudos e Formação da Ordem dos Advogados de Angola (CEF-OAA).<br><br>
        Após a validação do seu processo, ser-lhe-á enviado um Número de Referência para efectuar o pagamento da taxa de inscrição no valor de 
        AOA 70 000,00 (Setenta mil kwanzas), por meio de caixa de pagamento automático (Multicaixa) ou sistema internet banking.<br><br>
        Após a recepção da referência, caso não efectue o pagamento no prazo de 72 horas, o seu processo de inscrição será invalidado. Após a 
        confirmação do pagamento, o seu processo de inscrição será concluído.<br><br>
        Certifique-se de que as informações prestadas e os documentos submetidos são verdadeiros. A falta da veracidade dos mesmos, não dá 
        direito ao reembolso da taxa de inscrição.<br><br>
        Para mais informações sobre fases subsequentes da FIO , a hora e o local em que será realizada a formação, recomendamos que consulte 
        permanentemente o site do do CEF-OAA (www.cef-oaa.org) e mantenha-se atento ao endereço electrónico fornecido no acto de inscrição.<br><br>
        </p>
        <hr>
        <p>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>       
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2025 | Inscrição",
            "html" => $mensagem,
            "category" => "Inscrição - FIO - 2025"
        ];

        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        
        $response = json_decode($response);
        //return $response->success;

        if ($response->success == true) {
            return true;
        } else {
            return false;
        }
    }

    public function mailTurmaA($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Seja bem-vindo à FORMAÇÃO INICIAL OBRIGATÓRIA</h2>
        <hr>
        <p>
        Prezado(a) Formando(a) $nome;<br><br><br>
        Gostaríamos de informar que teremos um grupo do WhatsApp para facilitar a comunicação permanente entre o CEF-OAA e o(a)  formando(a). Para aceder ao grupo basta clicar em:
        <a href='https://chat.whatsapp.com/ErhhWYLZv0wIAlkS5TBdmC'>https://chat.whatsapp.com/ErhhWYLZv0wIAlkS5TBdmC</a><br><br>
        Pode também entrar em contacto via WhatsApp por meio do número de telefone 935 54 24 65, para ser adicionado ao grupo, enviando a mensagem Turma B.<br><br> 
        Melhores cumprimentos<br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2024",
            "html" => $mensagem,
            "category" => "FIO - 2024"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        return $response;
        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailGun($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Seja bem-vindo à FORMAÇÃO INICIAL OBRIGATÓRIA</h2>
        <hr>
        <p>
        Prezado(a) Formando(a) $nome, <br><br><br>
        Cumpre-nos informar que está prevista para o dia 17/05/2024, Sexta-Feira às 18:00 a sessão de abertura do 31º Curso da Formação Inicial Obrigatória.<br><br>
        Será realizada no anfiteatro da Universidade Gregório Semedo.<br><br>
        Outrossim, gostaríamos de informar que teremos um grupo do WhatsApp para facilitar a comunicação diária entre o CEF-OAA e o(a) formando(a), para aceder ao grupo basta clicar em:<br><br>
        <a href='https://chat.whatsapp.com/IUGMgw9xAM7GJz2UbLTAiZ'>https://chat.whatsapp.com/IUGMgw9xAM7GJz2UbLTAiZ</a><br><br>
        Pode também entrar em contacto via WhatsApp por meio dos números de telefone 935 54 24 65 ou 924 95 60 37 para ser adicionado ao grupo, enviando a mensagem TURMA A.<br><br>
        Melhores cumprimentos<br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>
        ";

        $dados_email = [

            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "from" => [
                "email" => "nganzadipedro.emp@gmail.com",
                "name" => "CEF - OAA"
            ],
            "headers" => [
                "X-Message-Source" => "demomailtrap.com"
            ],

            "subject" => "Your Example Order Confirmation",
            "html" => $mensagem,
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Accept: application/json",
            "Authorization: Bearer 2b0d9bd4486d33ac78a97cd3728ee641",
            "Api-Token: 2b0d9bd4486d33ac78a97cd3728ee641",
            "Content-Type: application/json"
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        return $response;

        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailTurmaB($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Seja bem-vindo à FORMAÇÃO INICIAL OBRIGATÓRIA</h2>
        <hr>
        <p>
        Prezado(a) Formando(a) $nome; <br><br><br>
        Fará parte da TURMA B do 32º curso da Formação Inicial Obrigatória.<br><br>
        Cumpre-nos informar, que por motivos de indisponibilidade de espaço e problemas técnicos nas instalações da Universidade Gregório Semedo, o início das aulas, a sessão de abertura do 32º Curso da Formação Inicial Obrigatória para a para a presente turma(Turma B), será adiada.<br><br>
        Informaremos brevemente o local e data em que a mesma poderá ser realizada.<br><br>  
        Outrossim, gostaríamos de informar que teremos um grupo do WhatsApp para facilitar a comunicação diária entre o CEF-OAA e o(a) formando(a), para aceder ao grupo basta clicar em:<br><br>
        <a href='https://chat.whatsapp.com/BesjI5xPrMH9W6J8HRQIFW'>https://chat.whatsapp.com/BesjI5xPrMH9W6J8HRQIFW</a><br><br>
        Pode também entrar em contacto via WhatsApp por meio dos números de telefone 935 54 24 65 ou 924 95 60 37 para ser adicionado ao grupo, enviando a mensagem TURMA B.<br><br>
        Melhores cumprimentos<br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>
        ";

        $dados_email = [
            "personalizations" => [
                [
                    "to" => [
                        [
                            "email" => $email,
                            "name" => $nome
                        ]
                    ],
                    "subject" => "FIO - 2024 | TURMA B - BOAS VINDAS"
                ]
            ],
            "content" => [
                [
                    "type" => "text/html",
                    "value" => $mensagem
                ]
            ],
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "reply_to" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ]
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer " . $this->sendgridApiKey,
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailSupervisores($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>EXAME NACIONAL DE ACESSO À ADVOCACIA</h2>
        <hr>
        <p>
        Ilustre Advogado(a) ou Advogado Estagiário(a) $nome; <br><br><br>
        O CEF-OAA serve-se do presente para confirmar a sua participação como Supervisor(a) do Exame Nacional de Acesso à advocacia 2024.<br><br>
        O exame será realizado no dia 31 de Maio no período das 10 às 13 horas.<br><br>
        Outrossim, gostaríamos de informar que teremos um grupo do WhatsApp para facilitar a comunicação permanente entre o CEF-OAA e o(a)  Supervisor(a). Para aceder ao grupo basta clicar em:
        <br><br>
        <a href='https://chat.whatsapp.com/DV2P2nT2ieyHTWtubbPdLS'>https://chat.whatsapp.com/DV2P2nT2ieyHTWtubbPdLS</a><br><br>
        Pode também entrar em contacto via WhatsApp por meio do número de telefone 935 54 24 65,  para ser adicionado ao grupo, enviando a mensagem SUPERVISOR 2024.<br><br>
        Melhores cumprimentos<br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>
        ";

        $dados_email = [
            "personalizations" => [
                [
                    "to" => [
                        [
                            "email" => $email,
                            "name" => $nome
                        ]
                    ],
                    "subject" => "ENOAA - 2024 | SUPERVISORES"
                ]
            ],
            "content" => [
                [
                    "type" => "text/html",
                    "value" => $mensagem
                ]
            ],
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "reply_to" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ]
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer " . $this->sendgridApiKey,
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailPagamento($email, $nome, $password)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Formação Inicial Obrigatória | Confirmação de Pagamento</h2>
        <hr>
        <p>
            Exmo(a). Senhor(a) $nome, <br><br><br>
            Servimo-nos do presente para informar que o pagamento da taxa de inscrição foi efecuado com sucesso, estando assim concluído o 
            seu processo de inscrição para realização da Formação Inicial Obrigatória.<br><br>
            Para que esteja informado sobre as etapas subsequentes da FIO e saber a hora e o local em que fará a Formação Inicial Obrigatória, 
            recomendamos que consulte permanentemente o site do Centro de Estudos e Formação da Ordem dos Advogados de 
            Angola (www.cef-oaa.org) e mantenha-se atento ao endereço electrónico fornecido no acto de inscrição.<br><br>
            Para que tenha acesso à plataforma de formações, abaixo encontre as credenciais e o link para aceder à referida plataforma:<br><br>
            <strong>Email: </strong> $email <br>
            <strong>Senha: </strong> $password <br>
            Link de acceso à: <a href='https://fio.cef-oaa.org/login'>Plataforma de Formações</a>. <br>
        </p>
        <hr>
        <p>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>        
        ";


        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2025 | Confirmação de Pagamento",
            "html" => $mensagem,
            "category" => "Pagamentos - FIO - 2025"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailCredenciais($email, $nome, $password, $turma, $formacao)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Formação Inicial Obrigatória | Credenciais de Acesso a Plataforma</h2>
        <hr>
        <p>
            Exmo(a). Senhor(a) $nome, <br><br><br>
            Servimo-nos do presente para informar que a sua inscrição foi validada e que foi inserido(a) na seguinte turma:<br><br>
            Turma: $turma.<br>
            Formação: $formacao.<br><br>
            Para que tenha acesso à plataforma de formações, abaixo encontre as credenciais e o link para aceder à referida plataforma:<br><br>
            <strong>Email: </strong> $email <br>
            <strong>Senha: </strong> $password <br>
            Link de acceso à: <a href='https://fio.cef-oaa.org/login'>Plataforma de Formações</a>. <br>
        </p>
        <hr>
        <p>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>        
        ";


        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2025 | Credenciais",
            "html" => $mensagem,
            "category" => "Credenciais - FIO - 2025"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response);

        if ($response->success == true) {
            return true;
        } else {
            return false;
        }

    }

    public function mailCredenciais2($email, $nome, $password)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Formação Inicial Obrigatória | Credenciais de Acesso a Plataforma</h2>
        <hr>
        <p>
            Exmo(a). Senhor(a) $nome, <br><br><br>
            Para que tenha acesso à plataforma de formações, abaixo encontre as credenciais e o link para aceder à referida plataforma:<br><br>
            <strong>Email: </strong> $email <br>
            <strong>Senha: </strong> $password <br>
            Link de acceso à: <a href='https://fio.cef-oaa.org/login'>Plataforma de Formações</a>. <br>
        </p>
        <hr>
        <p>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>        
        ";


        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2025 | Credenciais",
            "html" => $mensagem,
            "category" => "Credenciais - FIO - 2025"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response);

        if ($response->success == true) {
            return true;
        } else {
            return false;
        }

    }

    public function mailUsuario($email, $nome, $telefone, $num_bi, $password)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Plataforma de Gestão de Formações | Credenciais de Acesso</h2>
        <hr>
        <p>
        $nome, o seu email foi cadastrado na Plataforma de Gestão de Formações. <br> <br>
        Agora poderás de forma fácil efectuar diversas operações que estão disponíveis na nossa plataforma de acordo ao teu nível de acesso.<br><br>
        O seu cadastro foi feito com as seguintes principais informações:<br> <br>
        <strong>Nome: </strong> $nome <br>
        <strong>Email: </strong> $email <br>
        <strong>Telefone: </strong> $telefone <br>
        <strong>Nº BI: </strong> $num_bi <br><br>
        Para que tenhas acesso a nossa plataforma, a seguir tens os teus dados de acesso e o link para aceder:<br> <br>
        </p>
        <p>
        Link de acceso: <a href='https://fio.cef-oaa.org/login'>Plataforma de Gestão das Formações</a>. <br>
        Queira, por favor, usar as credenciais de acesso que se seguem:<br>
        <strong>Email: </strong> $email <br>
        <strong>Password: </strong> $password <br> <br>
        </p>
        <hr>
        <p>
        Se alguma coisa não estiver a funcionar, ou em caso de dúvidas e esclarecimentos, não hesite em nos contactar.
        <br><br>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>       
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2025 | Credenciais",
            "html" => $mensagem,
            "category" => "Credenciais - FIO - 2025"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response);

        if ($response->success == true) {
            return true;
        } else {
            return false;
        }
        
    }

    public function mailConfirmacao($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Confirmação de disponibilidade | Formação Inicial Obrigatória</h2>
        <hr>
        <p>
        Caríssimo(a) Candidato(a) $nome, encontramos os seus dados na nossa base de dados com a situação pendente para a Formação Inicial Obrigatória.<br><br>
        Caso ainda tenha disponibilidade para fazer a formação, solicitamos que preencha o formulário a seguir, dentro de 48 Horas.<br><br>
        Link de acceso ao formulário: <a href='https://forms.gle/TUdetZPoS4MXvVoH9'>Formulário de Disponibilidade</a>.<br><br>
        Caso não preencher o formulário dentro do prazo estipulado, consideraremos a sua inscrição suspensa para a Turma A - 34º Ciclo de 2025.<br><br>
        </p>
        <p>
        <br><br>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>       
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2025 | Confirmação de Disponibilidade",
            "html" => $mensagem,
            "category" => "Disponibilidade - FIO - 2025"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response);

        if ($response->success == true) {
            return true;
        } else {
            return false;
        }
        
    }


    public function resetSenha($nome, $email, $token)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Exame Nacional de Acesso à Advocacia | Recuperação de senha</h2>
        <hr>
        <p>
        Exmo(a). Senhor(a) $nome,<br><br>
        Recebemos uma solicitação para recuperar a sua senha de acesso na nossa plataforma.<br>
        Se você reconhece essa acção, clique no link abaixo para prosseguir:
        </p>
        <p>
        Link para redefinir a senha: <a href='https://enoaa.cef-oaa.org/reset-password/$token'>Redefinir a minha senha</a>. <br><br>
        </p>
        <hr>
        <p>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        Atenciosamente, <br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>     
        ";

        $dados_email = [
            "personalizations" => [
                [
                    "to" => [
                        [
                            "email" => $email,
                            "name" => $nome
                        ]
                    ],
                    "subject" => "ENOAA - 2024 | Recuperação de Senha"
                ]
            ],
            "content" => [
                [
                    "type" => "text/html",
                    "value" => $mensagem
                ]
            ],
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "reply_to" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ]
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer " . $this->sendgridApiKey,
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function turmaC($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Seja bem-vindo à FORMAÇÃO INICIAL OBRIGATÓRIA</h2>
        <hr>
        <p>
        Prezado(a) Formando(a) $nome; <br><br><br>
        Fará parte da TURMA D do 32º curso da Formação Inicial Obrigatória.<br><br>
        Cumpre-nos informar, que está prevista para o dia 26 de Julho, Sexta feira a sessão de abertura do 32º Curso, turma D pelas 18 horas.<br><br>  
        Outrossim, gostaríamos de informar que teremos um grupo do WhatsApp para facilitar a comunicação diária entre o CEF-OAA e o(a) formando(a), para aceder ao grupo basta clicar em:<br><br>
        <a href='https://chat.whatsapp.com/Gf2AMa9VDAM1FkbavpOsyc'>https://chat.whatsapp.com/Gf2AMa9VDAM1FkbavpOsyc</a><br><br>
        Pode também entrar em contacto via WhatsApp por meio do número de telefone 935 54 24 65, para ser adicionado ao grupo, enviando a mensagem TURMA D.<br><br>
        Melhores cumprimentos<br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "TURMA D || FIO - 2024",
            "html" => $mensagem,
            "category" => "TURMA D"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        return $response;
        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

    public function mailZoom($email, $nome)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Seja bem-vindo à FORMAÇÃO INICIAL OBRIGATÓRIA</h2>
        <hr>
        <p>
        Prezado(a) Formando(a) $nome; <br><br><br>
        Cumpre-nos informar, que está prevista para o dia 06/09/2024, Sexta feira às 18:00 a sessão de abertura do 33º Curso da Formação Inicial Obrigatória.<br><br>  
        A SESSÃO DE ABERTURA SERÁ VIRTUAL.<br><br>
        Entrar Zoom Reunião<br><br>
        https://us02web.zoom.us/j/88403651852?pwd=G1sFOnvep8aRn61z2myCdkhzHMenQe.1<br><br>
        ID da reunião: 884 0365 1852<br><br>
        Senha: 226969<br><br><br>
        Melhores cumprimentos<br><br>
        CEF-OAA<br>
        CEF-OAA | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>
        Tel.: +244924956 037 | +244 935542465<br>
        E-mail:geral@cef-oaa.org | www.cef-oaa.org
        </p>
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.inscricao.enoaa@cef-oaa.org",
                "name" => "CEF - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "FIO - 2024",
            "html" => $mensagem,
            "category" => "FIO - 2024"
        ];


        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer d8a3c218f7efb6be2f3c11797af2e60e",
            "Content-Type: application/json",
        ];

        $opts = [
            CURLOPT_URL => "https://send.api.mailtrap.io/api/send",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_POSTFIELDS => $data
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        return $response;
        if ($response == "") {
            return true;
        } else {
            return false;
        }
    }

}
