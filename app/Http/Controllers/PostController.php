<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Auth;
use Illuminate\Http\Request;

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

        // regista actividade no sistema

        ActividadesistemaController::inserir(Auth::id(), "Cadastrou uma nova notícia ($noticia->titulo)", 'noticia', $noticia->id);
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
}
