<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{

    public function mailCredenciais($email, $nome, $password, $nivel_acesso)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Sistema de Gestão CPL - OAA | Credenciais de Acesso</h2>
        <hr>
        <p>
            Exmo(a). Senhor(a) $nome, <br><br><br>
            Servimo-nos do presente para partilhar as suas credenciais de acesso a plataforma de Gestão do Conselho Provincial de Luanda da Ordem dos Advogados de Angola.<br><br>
            Para que tenha acesso ao sistema, abaixo encontre as credenciais e o link para aceder à referida plataforma:<br><br>
            <strong>Email: </strong> $email <br>
            <strong>Senha: </strong> $password <br>
            <strong>Nível de Acesso: </strong> $nivel_acesso <br>
            <strong>Link de acceso ao sistema:</strong> <a href='https://cpl-oaa.ao/login'>Sistema de Gestão CPL - OAA</a>. <br>
        </p>
        <hr>
         <p>  
        Atenciosamente, <br>
        Equipa de Suporte Técnico do CPL-OAA<br><br>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        </p>        
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cpl-oaa.ao",
                "name" => "CPL - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "CPL - OAA | Bem - Vindo",
            "html" => $mensagem,
            "category" => "CPL - Novo Usuário"
        ];

        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer " . env('MAILTRAP_API_KEY'),
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

    public function mailUsuario($email, $nome, $telefone, $num_bi, $password, $nivel_acesso)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>Sistema de Gestão CPL - OAA || Bem - Vindo</h2>
        <hr>
        <p>
        $nome, o seu email foi cadastrado na plataforma web do Conselho Provincial de Luanda da Ordem dos Advogados de Angola. <br> <br>
        Agora poderás de forma fácil efectuar diversas operações que estão disponíveis na nossa plataforma de acordo ao teu nível de acesso.<br><br>
        O seu cadastro foi feito com as seguintes principais informações:<br> <br>
        <strong>Nome: </strong> $nome <br>
        <strong>Email: </strong> $email <br>
        <strong>Telefone: </strong> $telefone <br>
        <strong>Nº BI: </strong> $num_bi <br><br>
        <strong>Nível de Acesso: </strong> $nivel_acesso <br><br>
        Para que tenhas acesso a nossa plataforma, a seguir tens os teus dados de acesso e o link para aceder:<br> <br>
        </p>
        <p>
        Link de acceso: <a href='https://cpl-oaa.ao/login'>Sistema de Gestão CPL - OAA</a>. <br>
        Queira, por favor, usar as credenciais de acesso que se seguem:<br>
        <strong>Email: </strong> $email <br>
        <strong>Password: </strong> $password <br> <br>
        </p>
        <hr>
        <p>  
        Atenciosamente, <br>
        Equipa de Suporte Técnico do CPL-OAA<br><br>
        OBS: NÃO RESPONDA ESTE EMAIL.<br><br>
        </p>       
        ";

        $dados_email = [
            "from" => [
                "email" => "suporte.tecnico@cpl-oaa.ao",
                "name" => "CPL - OAA"
            ],
            "to" => [
                [
                    "email" => $email,
                    "name" => $nome
                ]
            ],

            "subject" => "CPL - OAA | Bem - Vindo",
            "html" => $mensagem,
            "category" => "CPL - Novo Usuário"
        ];

        $data = json_encode($dados_email);
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Bearer " . env('MAILTRAP_API_KEY'),
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

}
