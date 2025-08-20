<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\ProxyPayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\MailController;
use App\Models\Fio\Candidaturaformacao;
use App\Models\User;
use Carbon\Carbon;

class MIMOController extends Controller
{

   //private $key_api = 'ac27459950f157975c9d8c01934dce4b922674232';
   private $key_api = 'cb181d68dfe00c153a020ab8e5a9f6a7922674232';

   public function enviarMensagem($telefone, $texto_mensagem)
   {

       $dados_requisicao = [
           "sender"  => "CEF_OAA",
           "recipients"  => $telefone,
           "text"  => $texto_mensagem
       ];
   
       $data = json_encode($dados_requisicao);
   
       $curl = curl_init();
       $httpHeader = [
           "Content-Type: application/json",
       ];
      
       $opts = [
           CURLOPT_URL             => "http://52.30.114.86:8080/mimosms/v1/message/send?token=" . $this->key_api,
           CURLOPT_CUSTOMREQUEST   => "POST",
           CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
           CURLOPT_RETURNTRANSFER  => true,
           CURLOPT_TIMEOUT         => 30,
           CURLOPT_HTTPHEADER      => $httpHeader,
           CURLOPT_POSTFIELDS      => $data
       ];
      
       curl_setopt_array($curl, $opts);
      
       $response = curl_exec($curl);
       $err = curl_error($curl);
       curl_close($curl);
   
      return $response;


   }

   function criarContacto($nome, $contacto){

       $dados_requisicao = [
           "name"  => $nome,
           "countryCode"  => "244",
           "phone"  => $contacto
       ];
   
       $data = json_encode($dados_requisicao);
   
       $curl = curl_init();
       $httpHeader = [
           "Content-Type: application/json",
       ];
      
       $opts = [
           CURLOPT_URL             => "http://52.30.114.86:8080/mimosms/v1/contact/add?token=" . $this->key_api,
           CURLOPT_CUSTOMREQUEST   => "POST",
           CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
           CURLOPT_RETURNTRANSFER  => true,
           CURLOPT_TIMEOUT         => 30,
           CURLOPT_HTTPHEADER      => $httpHeader,
           CURLOPT_POSTFIELDS      => $data
       ];
      
       curl_setopt_array($curl, $opts);
      
       $response = curl_exec($curl);
       $err = curl_error($curl);
       curl_close($curl);
   
      var_dump($response);
   
   }
}
