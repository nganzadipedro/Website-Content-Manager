<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\ProxyPayRepository;
use App\Models\Fio\Aluno;
use App\Models\Fio\Emissaodeclaracao;
use Illuminate\Http\Request;

class APIDeclaracaoController extends Controller
{
    function validar_declaracao(Request $request)
    {

        $api_key = "usorxf47m24rjwdkrfn2ef6qhezxsd5j";

        $codigo_validacao = $request->codigo_validacao;
        $bilhete = $request->bilhete;
        $res = Emissaodeclaracao::whereRaw('BINARY min_hash = ?', [$codigo_validacao])->first();
        if ($res != null) {
            $aluno = Aluno::find($res->aluno_id);
            if ($aluno) {
                $pessoa = $aluno->getpessoa;
                if ($pessoa != null) {
                    if ($pessoa->num_documento === $bilhete) {
                        return response()->json([
                            'msg' => 'Declaração validada com sucesso.',
                            'status' => 'success'
                        ]);
                    } else {
                        return response()->json([
                            'msg' => 'Declaração não validada. O número do bilhete não foi confirmado na base de dados do CEF-OAA.',
                            'status' => 'error'
                        ]);
                    }
                } else {
                    return response()->json([
                        'msg' => 'Formando não existe na base de dados do CEF-OAA.',
                        'status' => 'error'
                    ]);
                }
            } else {
                return response()->json([
                    'msg' => 'Formando não existe na base de dados do CEF-OAA.',
                    'status' => 'error'
                ]);
            }
        } else {
            return response()->json([
                'msg' => 'Código de validação não existe na base de dados do CEF-OAA.',
                'status' => 'error'
            ]);
        }
    }
}
