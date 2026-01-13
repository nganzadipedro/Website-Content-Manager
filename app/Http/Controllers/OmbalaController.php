<?php

namespace App\Http\Controllers;

class OmbalaController extends Controller
{
   private $key_api = 'ab884fdf-6778-428c-ad03-dc0f6d198df0';

   public function enviarMensagem($telefone, $texto_mensagem)
   {

       $dados_requisicao = [
           "message"  => $texto_mensagem,
           "from"  => "CPL-OAA",
           "to"  => "".$telefone
       ];
   
       $data = json_encode($dados_requisicao);
   
       $curl = curl_init();
       $httpHeader = [
            "Authorization: Token " . $this->key_api,
            "Content-Type: application/json",
       ];
      
       $opts = [
           CURLOPT_URL             => "https://api.useombala.ao/v1/messages",
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

}
