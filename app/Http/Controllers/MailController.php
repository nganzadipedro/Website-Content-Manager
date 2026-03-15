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

        return $response;

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

    public function mailDespacho($email, $nome, $mensagem, $data_despacho)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>CPL - OAA || Inscrição OAA</h2>
        <hr>
        <p>
        Exmo/a Dr.(ª) $nome<br><br>
        Por despacho datado de $data_despacho do Conselho Provincial de Luanda, que incidiu sobre o seu processo de inscrição, somos a transcrever o seguinte despacho:<br><br>
        <strong>$mensagem</strong><br><br><br>
        <strong>Para mais informações, contacte a secretaria deste Conselho.<br>
        Largo João Seca, Casa n.º 6, R/C - Telef. 928 410 082<br><br></strong>
        Sem mais de momento, atenciosamente,<br>
        Assistente Administrativo<br>
        Conselho Provincial de Luanda<br>
        Ordem dos Advogados de Angola<br>
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

            "subject" => "CPL - OAA | Despacho",
            "html" => $mensagem,
            "category" => "CPL - Despacho"
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

    public function mailNotificacao($email, $nome, $mensagem, $data_entrada)
    {

        // mensagem do email
        $mensagem = "
        <h2 style='color: #2F5496; font-weight: bold;'>CPL - OAA || Notificação</h2>
        <hr>
        <p>
        Exmo/a Dr.(ª) $nome<br><br>
        Em função do processo que deu entrada no CPL-OAA na data $data_entrada, informamos o seguinte:<br><br>
        <strong>$mensagem</strong><br><br>
        <strong>Para mais informações, contacte a secretaria deste Conselho.<br>
        Largo João Seca, Casa n.º 6, R/C - Telef. 928 410 082<br><br></strong>
        Sem mais de momento, atenciosamente,<br>
        Conselho Provincial de Luanda<br>
        Ordem dos Advogados de Angola<br>
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

            "subject" => "CPL - OAA | Notificação",
            "html" => $mensagem,
            "category" => "CPL - Notificação"
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

}
