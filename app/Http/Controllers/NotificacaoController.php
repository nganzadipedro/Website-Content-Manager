<?php

namespace App\Http\Controllers;

use App\Models\Advogadoatribuido;
use App\Models\Carrossel;
use App\Models\Denuncia;
use App\Models\Documentoaj;
use App\Models\Estagiariospatrono;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Patrono;
use App\Models\Pedidoassistencia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use App\Models\Relatoriofinanceiro;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class NotificacaoController extends Controller
{

    public static function send_num_processo($tel, $email, $nome, $num_processo)
    {

        $message = "Caríssimo(a) " . $nome . ", o seu processo de inscrição foi registado com o seguinte número de processo: " . $num_processo;
        // Enviar SMS
        $sms = new OmbalaController();
        $sms->enviarMensagem($tel, $message);

        // Enviar Email
        // Aqui você pode adicionar a lógica para enviar o email usando uma biblioteca de envio de emails
        // Exemplo: PHPMailer, SwiftMailer, etc.

    }

}
