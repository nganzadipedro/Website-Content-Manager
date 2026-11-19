<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use App\Models\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\StoreTrait;
use App\Models\Candidate;
use App\Models\Wallet;
use App\Models\Candidatura;
use Carbon\Carbon;

class FactPlusRepository
{

    private $key_api = '615c4e01127ee4f12404f109f9fbca52';
    private $endpoint = 'https://api.factplus.co.ao';

    public function gerarFacturaRecibo($email, $cidade, $nome)
    {

        // pega a data de hoje
        $today = Carbon::today();
        $data_doc = substr($today, 0, 10);

        $dados_documento = [
            "apicall"        => "CREATE",
            "apikey"        => $this->key_api,
            "document" => [
                "type" => "factura-recibo",
                "date" => $data_doc,
                "duedate" => $data_doc,
                "vref" => "",
                "serie" => "2023",
                "currency" => "AOA",
                "exchange_rate" => "0",
                "observation" => "",
                "retention" => "0"
            ],
            "client" => [
                "name" =>  $nome,
                "nif" =>  "",
                "email" =>  $email,
                "city" =>  $cidade,
                "address" => $cidade,
                "postalcode" => "",
                "country" => "Angola"
            ],
            "items" => [
                [
                    "itemcode" => "ENOAA",
                    "description" => "Exame Nacional de Acesso à Advocacia",
                    "price" => "25000",
                    "quantity" => "1",
                    "tax" => "0",
                    "discount" => "0",
                    "exemption_code" => "M10",
                    "retention" => ""
                ]
            ]
        ];

        $data = json_encode($dados_documento);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.factplus.co.ao",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);
        
        $this->alterarEstado($result->data);
        $this->enviarEmail($result->data, $email);
       
    }

    public function enviarEmail($reference, $email)
    {

        $dados_documento = [
            "apicall"        => "SEND",
            "apikey"        => $this->key_api,
            "document" => [
                "reference" => $reference,
                "type" => "factura-recibo"
            ],
            "recipient" => [
                "address" => $email,
                "subject" => "Factura-Recibo | Inscrição",
                "message" => "Factura-Recibo do Pagamento da Inscrição ao Exame Nacional de Acesso à Advocacia",
                "copy" => "0"
            ]
        ];

        $data = json_encode($dados_documento);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.factplus.co.ao",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function alterarEstado($reference)
    {

        $dados_documento = [
            "apicall"        => "ALTER",
            "apikey"        => $this->key_api,
            "document" => [
                "reference" => $reference,
                "type" => "factura-recibo",
                "status" => "settled",
                "reason" => "",
            ]
        ];

        $data = json_encode($dados_documento);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.factplus.co.ao",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        
    }
}
