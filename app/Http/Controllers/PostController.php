<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Platform\Advogado;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function newslater_post(Request $request)
    {

        $noticia = Noticia::create([
            'titulo' => $request->titulo,
            'texto_resumo' => $request->texto_resumo,
            'texto_completo' => $request->texto_completo,
            'categoria' => $request->categoria,
            'e_destaque' => $request->e_destaque,
            'user_id' => Auth::id()
        ]);

        $noticia->hash = md5($noticia->tittulo . $noticia->created_at);
        $noticia->save();

        //faz upload da imagem
        $imagem = '';

        try {
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $imagem = $request->imagem->store('noticias');
                $noticia->imagem = $imagem;
                $noticia->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        // os destques antigos deixam de ser destaques
        if ($noticia->e_destaque == 'sim') {
            $antigos = Noticia::where('e_destaque', 'sim')->get();
            if (count($antigos) > 0) {

                foreach ($antigos as $ant) {
                    $ant->e_destaque = 'nao';
                    $ant->save();
                }

            }

            $noticia->e_destaque = 'sim';
            $noticia->save();

        }

        ActividadesistemaController::inserir(Auth::id(), "Cadastrou uma nova notícia ($noticia->titulo)", 'noticia', $noticia->id);
        return 'sucesso';

    }

    public function gallery_post(Request $request)
    {

        $galeria = Galeria::create([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
            'user_id' => Auth::id()
        ]);

        $galeria->hash = md5($galeria->tittulo . $galeria->created_at);
        $galeria->save();

        //faz upload da imagem
        $imagem = '';

        try {
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $imagem = $request->imagem->store('galeria');
                $galeria->imagem = $imagem;
                $galeria->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        // regista actividade no sistema

        ActividadesistemaController::inserir(Auth::id(), "Adicionou uma nova imagem da galeria ($galeria->titulo)", 'galeria', $galeria->id);
        return 'sucesso';

    }

    public function newslater_update(Request $request)
    {

        $noticia = Noticia::where('hash', $request->hash_noticia)->first();

        $noticia->titulo = $request->titulo;
        $noticia->texto_resumo = $request->texto_resumo;
        $noticia->texto_completo = $request->texto_completo;
        $noticia->categoria = $request->categoria;
        $noticia->e_destaque = $request->e_destaque;
        $noticia->save();

        //faz upload da imagem
        $imagem = '';

        try {
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $imagem = $request->imagem->store('noticias');
                $noticia->imagem = $imagem;
                $noticia->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Editou a notícia ($noticia->titulo)", 'noticia', $noticia->id);
        return 'sucesso';

    }
    public function delete_news(Request $request)
    {

        $noticia = Noticia::find($request->id_news);
        $noticia->delete();

        ActividadesistemaController::inserir(Auth::id(), "Eliminou uma notícia ($noticia->titulo)", 'noticia', $noticia->id);
        return 'sucesso';

    }

    public function delete_gallery(Request $request)
    {

        $galeria = Galeria::find($request->id_news);
        $galeria->delete();

        ActividadesistemaController::inserir(Auth::id(), "Eliminou uma imagem da galeria ($galeria->titulo)", 'noticia', $galeria->id);
        return 'sucesso';

    }

    public function complaint_post(Request $request)
    {

        $denuncia = Denuncia::create([
            'nome' => $request->name,
            'assunto' => $request->subject,
            'mensagem' => $request->message,
        ]);

        $denuncia->hash = md5($denuncia->nome . $denuncia->created_at);
        $denuncia->save();

        //faz upload do ficheiro
        $ficheiro = '';

        try {
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $ficheiro = $request->file->store('denunciareclamacao');
                $denuncia->ficheiro = $ficheiro;
                $denuncia->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        // regista actividade no sistema
        ActividadesistemaController::inserir(null, "Utente submeteu uma denúncia/reclamação ($denuncia->assunto)", 'geral', null);
        return 'sucesso';

    }

    public function message_post(Request $request)
    {

        $mensagem = Mensagem::create([
            'nome' => $request->name,
            'email' => $request->email,
            'assunto' => $request->subject,
            'tipo_remetente' => $request->senderType,
            'mensagem' => $request->message,
            'num_identificacao' => $request->identification
        ]);

        $mensagem->hash = md5($mensagem->nome . $mensagem->created_at);
        $mensagem->save();

        // regista actividade no sistema
        ActividadesistemaController::inserir(null, "Utente enviou uma mensagem ($mensagem->assunto)", 'geral', null);
        return 'sucesso';

    }

    public function getfile($filename)
    {

        $path = 'public/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'Arquivo não encontrado.');
        }

        $file = Storage::path($path);

        return response()->file($file, [
            'Content-Type' => 'application/pdf',
        ]);

    }

    public function gallery_views(Request $request)
    {

        $galeria = Galeria::where('hash', $request->hash)->first();
        $galeria->views = $galeria->views + 1;
        $galeria->save();

        return response()->json([
            'success' => true,
            'message' => 'Operação realizada com sucesso.'
        ]);

    }

    public function search_lawyer(Request $request)
    {

        $criterio = $request->search_select;
        $texto_filtro = $request->text_search;

        if ($criterio == 'nome') {
            $res = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')->where('pessoa.nome', 'LIKE', "%{$texto_filtro}%")
                ->select('pessoa.*', 'app_advogado.categoria', 'app_advogado.num_associado', 'app_advogado.num_estagiario')
                ->get();
        } else if ($criterio == 'cedula') {
            $res = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')->where('app_advogado.num_associado', 'LIKE', "%{$texto_filtro}%")
                ->orWhere('app_advogado.num_estagiario', 'LIKE', "%{$texto_filtro}%")
                ->select('pessoa.*', 'app_advogado.categoria', 'app_advogado.num_associado', 'app_advogado.num_estagiario')
                ->get();


        } else if ($criterio == 'bi') {
            $res = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')->where('pessoa.num_documento', 'LIKE', "%{$texto_filtro}%")
                ->select('pessoa.*', 'app_advogado.categoria', 'app_advogado.num_associado', 'app_advogado.num_estagiario')
                ->get();
        }

        if(count($res) == 0){
            return [
                'has_rows' => 'false'
            ];
        }
        else{
              return [
                'has_rows' => 'true',
                'rows' => $res
              ];
        }
    }

}
