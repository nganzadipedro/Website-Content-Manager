<?php

namespace App\Http\Controllers;

use App\Models\Enoaa\Ano;
use App\Models\Fio\Solicitacaodocumento;
use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\MailController;
use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Pagamento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProxyPayController extends Controller
{

    // private $key_api = 'kebmcj2e6slg50uus76cm79b77apn4v3';
    private $key_api = 'usorxf47m24rjwdkrfn2ef6qhezxsd5j';
    private $endpoint = 'https://api.proxypay.co.ao/';
    // private $endpoint = 'https://api.sandbox.proxypay.co.ao/';
    private $callback = 'https://fio.cef-oaa.org/api/payment';


    public function gerarReferencia($tel, $email, $nome, $valor_pagar, $dias = 3)
    {

        $num_referencia = $this->gerarIdReferencia();

        // pega a data de hoje
        $today = Carbon::today();
        // aumenta dois dias
        $data_expiracao = $today->addDays($dias);
        // tira a parte da hora
        $data_expiracao = substr($data_expiracao, 0, 10);

        $reference = [
            "amount" => $valor_pagar,
            "end_datetime" => $data_expiracao,
            "custom_fields" => [
                "mobile" => $tel,
                "email" => $email,
                "description" => "CEF-OAA FIO",
                "name" => $nome,
                "callback_url" => $this->callback
            ]
        ];

        $data = json_encode($reference);
        $curl = curl_init();
        $httpHeader = [
            "Authorization: " . "Token " . $this->key_api,
            "Accept: application/vnd.proxypay.v2+json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)
        ];

        $opts = [
            CURLOPT_URL => $this->endpoint . "references/" . $num_referencia,
            CURLOPT_CUSTOMREQUEST => "PUT",
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

        // return $response;
        return $num_referencia;

    }

    public function criarPagamentoSimulado($referencia, $valor)
    {
        $payment = [
            "reference_id" => $referencia,
            "amount" => $valor
        ];

        $data = json_encode($payment);

        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . $this->key_api,
            "Accept: application/vnd.proxypay.v2+json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)
        ];

        $opts = [
            CURLOPT_URL => $this->endpoint . "payments",
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
    }

    public function todosPagamentos()
    {
        // pegar todos pagamentos
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . $this->key_api,
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $opts = [
            CURLOPT_URL => $this->endpoint . "payments?n=100",
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }

    public function gerarIdReferencia()
    {
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . $this->key_api,
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $opts = [
            CURLOPT_URL => $this->endpoint . "reference_ids",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }

    public function eliminarReferencia($referencia)
    {
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . $this->key_api,
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $opts = [
            CURLOPT_URL => $this->endpoint . "references/" . $referencia,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }

    public function reconhecerPagamento($referencia)
    {
        $curl = curl_init();

        $httpHeader = [
            "Authorization: " . "Token " . $this->key_api,
            "Accept: application/vnd.proxypay.v2+json",
        ];

        $opts = [
            CURLOPT_URL => $this->endpoint . "payments/" . $referencia,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);

        // var_dump($response);
        // die();
        $err = curl_error($curl);

        curl_close($curl);
    }

    public function processaPagamento($referencia)
    {

        $ano_activo = Ano::where('estado', 'Activo')->first();
        // verificar referência de pagamento na tabela das candidaturas
        $candidatura = Candidaturaformacao::where("referencia", "=", "{$referencia}")->first();

        if ($candidatura != null) {

            $user = User::where('pessoa_id', $candidatura->pessoa_id)->first();

            // gera factura de pagamento
            $ob = new FactPlusController();
            $ref_factura = $ob->gerarFacturaRecibo($candidatura->getPessoa->email, 'Luanda', $candidatura->getPessoa->nome, "FIOP", "Formação Inicial Obrigatória Presencial", "70000");

            $candidatura->pago = 'pago';
            $candidatura->referencia_factura = $ref_factura;
            $candidatura->save();

            // insere na tabela de alunos
            $existe = Aluno::where('pessoa_id', $candidatura->pessoa_id)->first();
            $aluno = null;
            if ($existe) {
                $aluno = $existe;
            } else {
                $aluno = Aluno::create([
                    'pessoa_id' => $candidatura->pessoa_id,
                    'codigo' => $candidatura->codigo,
                    'num_cedula_advogado' => $candidatura->num_cedula,
                    'documento_bilhete' => $candidatura->bilhete_identidade,
                    'documento_cedula' => $candidatura->cedula_advogado,
                    'nome_patrono' => $candidatura->nome_patrono,
                    'email_patrono' => $candidatura->email_patrono,
                    'telefone_patrono' => $candidatura->telefone_patrono,
                    'nome_escritorio' => $candidatura->nome_escritorio,
                    'endereco_escritorio' => $candidatura->endereco_escritorio
                ]);
            }

            $aluno->hash = md5($aluno->id . $candidatura->id . $aluno->created_at);
            $aluno->save();
            $candidatura->aluno_id = $aluno->id;
            $candidatura->save();

            // insere na tabela aluno_formacao
            $existe = null;
            $existe = Alunoformacao::where('aluno_id', $aluno->id)->first();
            if ($existe) {
                $existe->turma_id = $candidatura->turma_id;
                $existe->formacao_id = $candidatura->formacao_id;
                $existe->save();
            } else {
                $aluno_formacao = Alunoformacao::create([
                    'aluno_id' => $aluno->id,
                    'turma_id' => $candidatura->turma_id,
                    'formacao_id' => $candidatura->formacao_id
                ]);
            }


            // insere na tabela de pagamentos
            $pagamento = Pagamento::create([
                'aluno_id' => $aluno->id,
                'formacao_id' => $candidatura->formacao_id,
                'descricao' => "Pagamento da inscrição",
                'emolumento_id' => 1,
                'referencia' => $referencia,
                'referencia_factura' => $ref_factura,
                'forma_pagamento' => 'Referência',
                'ano_id' => $ano_activo->id
            ]);

            $user = User::where('pessoa_id', $aluno->pessoa_id)->first();
            $password = $aluno->codigo . $user->id;
            $user->password = md5($password);
            $user->save();

            // envia email de confirmação de pagamento
            $ob = new MailController();
            $res = $ob->mailPagamento($candidatura->getPessoa->email, $candidatura->getPessoa->nome, $password);
            if ($res == true) {
                // regista actividade do sistema
                ActividadesistemaController::inserir(null, 'Enviou email de confirmação de pagamento', 'Sistema', 'candidatura', $candidatura->id);
            }

            // altera o estado da factura
            $ob = new FactPlusController();
            $ob->alterarEstado($ref_factura);

            // envia mail com a factura
            $ob->enviarEmail($ref_factura, $candidatura->getPessoa->email);

            // regista actividade do sistema
            ActividadesistemaController::inserir($user->id, 'Fez o pagamento da inscrição', 'Candidato', 'candidatura', $candidatura->id);

            return response()->json("", 200);
        } else {

            // verifica na solicitacao de declaracao
            $solicitacao = Solicitacaodocumento::where('referencia', $referencia)
                ->where('estado', 'pendente')
                ->first();

            if ($solicitacao != null) {

                // actualiza a solicitação
                $solicitacao->estado = 'aprovado';
                $solicitacao->save();

                // insere na tabela de pagamentos
                $pagamento = Pagamento::create([
                    'aluno_id' => $solicitacao->aluno_id,
                    'formacao_id' => $solicitacao->formacao_id,
                    'descricao' => "Pagamento da declaração FIO",
                    'emolumento_id' => 2,
                    'solicitacao_id' => $solicitacao->id,
                    'referencia' => $referencia,
                    'forma_pagamento' => 'Referência',
                    'ano_id' => $ano_activo->id
                ]);

                // gera factura de pagamento
                $ob = new FactPlusController();
                $ref_factura = $ob->gerarFacturaRecibo($solicitacao->getAluno->getPessoa->email, 'Luanda', $solicitacao->getAluno->getPessoa->nome, "FIODC", "Declaração de Conclusão da Formação Inicial Obrigatória", "500");
                $ob->alterarEstado($ref_factura);
                $ob->enviarEmail($ref_factura, $pagamento->getAluno->getPessoa->email);

                $pagamento->referencia_factura = $ref_factura;
                $pagamento->save();

                // regista actividade do sistema
                $user = User::where('pessoa_id', $pagamento->getAluno->pessoa_id)->first();
                $candidatura = Candidaturaformacao::where('pessoa_id', $pagamento->getAluno->pessoa_id)
                    ->where('formacao_id', $pagamento->formacao_id)->first();
                ActividadesistemaController::inserir($user->id, 'Fez o pagamento da declaração da FIO', 'Candidato', 'candidatura', $candidatura->id);

                return response()->json("", 200);

            } else {

                // verifica na tabela de formação especializada

                $registo = DB::connection('mysql')->select("select * from formacao_espec where referencia = '$referencia'");
                if ($registo != null && count($registo) > 0) {

                    $id = $registo[0]->id;
                    $nome = strtoupper($registo[0]->nome);
                    $email = strtolower($registo[0]->email);

                    // gera factura de pagamento
                    $ob = new FactPlusController();
                    $ref_factura = $ob->gerarFacturaRecibo($email, 'Luanda', $nome, "FE", "Formação Especializada em Auditoria Jurídica Empresarial", "60000");
                    $ob->alterarEstado($ref_factura);
                    $ob->enviarEmail($ref_factura, $email);
                    $res = DB::connection('mysql')->update("update formacao_espec set pago = 'Sim', ref_factura = $ref_factura where id = $id");

                    return response()->json("", 200);

                }

                return response()->json("", 400);

            }

        }
    }
}
