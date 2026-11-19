<?php

namespace App\Http\Livewire\Formador;

use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Disciplina;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Prova;
use App\Models\Fio\Sistemaavaliacao;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Configuraravaliacao extends Component
{

    public $turmas = array();
    public $lista = array();

    public $professor;
    public $disciplina_id;
    public $professor_id;
    public $turma_id;
    public $qtd_notas_lancar;
    public $criterio_resultado_final;
    public $percent_nota1;
    public $percent_nota2;
    public $prov_seg_nota;
    public $tipo_prova;

    public function render()
    {

        $this->professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $this->turmas = Professorformacao::where('professor_id', $this->professor->id)->orderBy('id', 'desc')->get();
        $this->lista = Sistemaavaliacao::where('professor_id', $this->professor->id)->get();
        return view('dashboard.formador.configurar-avaliacao')->extends('layouts.app')->section('conteudo');
    }

    public function cadastrar()
    {

        $turma = Turma::find($this->turma_id);
        $prof_formacao = Professorformacao::where('professor_id', $this->professor->id)
            ->where('turma_id', $this->turma_id)->first();

        if ($prof_formacao) {

            $this->disciplina_id = $prof_formacao->disciplina_id;


            $existe = Avaliacaoaluno::where('turma_id', $prof_formacao->turma_id)
                ->where('disciplina_id', $prof_formacao->disciplina_id)
                ->get();

            if (count($existe) > 0) {
                $this->mensagem('Esta configuração não pode ser adicionada. As notas já foram lançadas.', 'warning');
            } else {

                $verifica = Sistemaavaliacao::where('turma_id', $turma->id)
                    ->where('disciplina_id', $this->disciplina_id)
                    ->where('professor_id', $this->professor->id)
                    ->first();

                if ($verifica) {
                    $this->mensagem('Já existe uma configuração para esta turma', 'warning');
                } else {

                    if ($this->qtd_notas_lancar == 2 && $this->prov_seg_nota == '') {
                        $this->mensagem('Selecione a proveniência da 2ª nota', 'warning');
                    } else if ($this->qtd_notas_lancar == 2 && $this->criterio_resultado_final == '') {
                        $this->mensagem('Selecione a fórmula de obtenção da nota final', 'warning');
                    } else if ($this->criterio_resultado_final == 'criterio-percentual' && $this->percent_nota1 == '') {
                        $this->mensagem('Digite a percentagem para a primeira nota', 'warning');
                    } else if ($this->criterio_resultado_final == 'criterio-percentual' && $this->percent_nota2 == '') {
                        $this->mensagem('Digite a percentagem para a segunda nota', 'warning');
                    } else if ($this->criterio_resultado_final == 'criterio-percentual' &&($this->percent_nota1 + $this->percent_nota2) < 100) {
                        $this->mensagem('O total das percentagens não é válido', 'warning');
                    } else {

                        $registo = Sistemaavaliacao::create([
                            'disciplina_id' => $this->disciplina_id,
                            'criterio_resultado_final' => $this->criterio_resultado_final,
                            'qtd_notas_lancar' => $this->qtd_notas_lancar,
                            'qtd_provas' => 1,
                            'percent_nota1' => $this->percent_nota1,
                            'percent_nota2' => $this->percent_nota2,
                            'prov_seg_nota' => $this->prov_seg_nota,
                            'tipo_prova' => $this->tipo_prova,
                            'professor_id' => $this->professor->id,
                            'turma_id' => $this->turma_id,
                            'user_id' => Auth::id()
                        ]);

                        $registo->hash = md5($registo->created_at . $registo->id);
                        $registo->save();

                        $this->mensagemRefresh('Configuração adicionada com sucesso', 'success');
                        $this->limpar();

                    }

                }

            }

        }
    }

    public function eliminar($id_config)
    {

        $config = Sistemaavaliacao::find($id_config);
        if ($config) {

            $existe = Avaliacaoaluno::where('turma_id', $config->turma_id)
                ->where('disciplina_id', $config->disciplina_id)
                ->get();

            if (count($existe) > 0) {
                $this->mensagem('Esta configuração não pode ser eliminada', 'warning');
            } else {
                $config->delete();
                $this->mensagemRefresh('Configuração adicionada com sucesso', 'success');
            }

        }
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 2000,
            'icon' => $icon,
            // 'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }

    public function limpar()
    {
        $this->turma_id = null;
        $this->qtd_notas_lancar = null;
        $this->tipo_prova = null;
        $this->percent_nota1 = null;
        $this->percent_nota2 = null;
        $this->criterio_resultado_final = null;
        $this->prov_seg_nota = null;
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }

}
