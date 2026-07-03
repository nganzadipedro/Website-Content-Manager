<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<title>Relatório de Inscrições</title>
<style>
  /*
    Este template é renderizado pelo DomPDF (barryvdh/laravel-dompdf).
    O DomPDF NÃO suporta flexbox nem CSS grid — por isso o layout usa
    <table> e float em vez disso.

    Paleta: apenas texto preto + tonalidades de amarelo (sem azul,
    verde ou vinho). Espaço reservado à esquerda do cabeçalho para o
    logotipo da instituição.
  */

  @page {
    margin: 90px 36px 70px 36px;
  }

  * { box-sizing: border-box; }

  body{
    font-family: "Helvetica", Arial, sans-serif;
    color:#141414;
    font-size: 10.5px;
    line-height:1.5;
  }

  /* ===== Cabeçalho fixo (repete em todas as páginas) ===== */
  header{
    position: fixed;
    top: -70px;
    left: 0;
    right: 0;
    height: 70px;
  }
  .masthead{
    width:100%;
    border-collapse:collapse;
    border-bottom: 3px double #c99a2e;
    padding-bottom:10px;
  }
  .masthead td{ vertical-align:bottom; padding-bottom:10px; }

  /* Espaço reservado para o logotipo da instituição */
  .masthead .logo-slot{
    width:60px;
    height:48px;
    text-align:center;
    vertical-align:middle;
  }
  .masthead .logo-slot img{
    max-width:60px;
    max-height:48px;
  }

  .masthead .titles{ padding-left:14px; }
  .masthead .eyebrow{
    margin:0 0 3px;
    text-transform:uppercase;
    letter-spacing:1.5px;
    font-size:8px;
    color:#8a6d1a;
  }
  .masthead h1{
    margin:0;
    font-size:16px;
    color:#141414;
  }
  .masthead .org-name{
    text-align:right;
    font-size:9px;
    color:#141414;
    font-style:italic;
  }
  .masthead .org-name strong{
    display:block;
    font-style:normal;
    font-size:10.5px;
    color:#141414;
  }

  /* ===== Rodapé fixo (repete em todas as páginas) ===== */
  footer{
    position: fixed;
    bottom: -60px;
    left: 0;
    right: 0;
    height: 50px;
    border-top: 1px solid #e8cf7d;
    padding-top:8px;
    font-size:8px;
    color:#141414;
  }
  footer table{ width:100%; }
  footer .pagenum:before {
    content: "Página " counter(page) " de " counter(pages);
  }

  /* ===== Corpo do documento ===== */
  .periodo-box{
    background:#fdf3d0;
    border:1px solid #e8cf7d;
    border-left:4px solid #c99a2e;
    padding:10px 14px;
    margin:6px 0 18px;
    font-size:10.5px;
    color:#141414;
  }
  .periodo-box strong{ color:#141414; }

  /* Cartões de resumo em tabela de 4 colunas (substitui CSS grid) */
  table.stats{
    width:100%;
    border-collapse: separate;
    border-spacing: 8px 0;
    margin-bottom:18px;
  }
  table.stats td{
    width:25%;
    border:1px solid #e8cf7d;
    border-top:3px solid #c99a2e;
    padding:10px 12px;
    background:#fffdf5;
  }
  table.stats .num{
    font-size:19px;
    font-weight:bold;
    color:#141414;
    display:block;
  }
  table.stats .label{
    font-size:7.5px;
    text-transform:uppercase;
    letter-spacing:0.5px;
    color:#141414;
    margin-top:4px;
    display:block;
  }

  /* Tabela principal de registos */
  table.registos{
    width:100%;
    border-collapse:collapse;
    font-size:9.5px;
  }
  table.registos thead th{
    background:#c99a2e;
    color:#141414;
    text-align:left;
    padding:7px 8px;
    font-size:8px;
    text-transform:uppercase;
    letter-spacing:0.4px;
    border-bottom:1px solid #8a6d1a;
  }
  table.registos thead th.num-col{ text-align:right; }
  table.registos tbody td{
    padding:6px 8px;
    border-bottom:1px solid #f0e2b0;
    color:#141414;
  }
  table.registos tbody td.num-col{ text-align:right; }
  table.registos tbody tr:nth-child(even){ background:#fdf6de; }

  .badge{
    display:inline-block;
    padding:2px 7px;
    border-radius:8px;
    font-size:8px;
    font-weight:bold;
    color:#141414;
  }
  .badge.advogado{ background:#e8b923; }
  .badge.estagiario{ background:#fdf0bf; border:1px solid #e8b923; }

  .situacao{ font-size:9px; color:#141414; }
  .situacao .dot{
    display:inline-block;
    width:6px; height:6px;
    border-radius:50%;
    margin-right:4px;
  }
  .situacao.ativa .dot{ background:#c99a2e; }
  .situacao.ativa{ font-weight:bold; }
  .situacao.pendente .dot{
    background:#fff;
    border:1px solid #c99a2e;
    width:5px; height:5px;
  }

  .empty-state{
    text-align:center;
    padding:30px 10px;
    color:#141414;
    font-style:italic;
    border:1px dashed #e8cf7d;
  }

  /* Bloco de assinatura / validação, no fim do documento */
  .assinatura{
    margin-top:46px;
    width:100%;
  }
  .assinatura table{ width:100%; }
  .assinatura .linha{
    border-top:1px solid #141414;
    width:70%;
    margin:34px auto 4px;
  }
  .assinatura .legenda{
    text-align:center;
    font-size:9px;
    color:#141414;
  }
</style>
</head>
<body>

  <header>
    <table class="masthead">
      <tr>
        <td class="logo-slot">
          {{-- Substitua pelo logotipo real, ex:
               <img src="{{ public_path('images/logo-instituicao.png') }}" alt="Logótipo"> --}}
          @if(!empty($logoPath))
            <img src="{{ $logoPath }}" alt="Logótipo">
          @endif
        </td>
        <td class="titles">
          <p class="eyebrow">Ordem dos Advogados</p>
          <h1>Relatório de Inscrições</h1>
        </td>
        <td class="org-name">
          <strong>Conselho Geral</strong>
          Departamento de Registo e Inscrição
        </td>
      </tr>
    </table>
  </header>

  <footer>
    <table>
      <tr>
        <td style="text-align:left;">
          Documento gerado em {{ $geradoEm }}
        </td>
        <td style="text-align:right;" class="pagenum"></td>
      </tr>
    </table>
  </footer>

  {{-- Período do relatório --}}
  <div class="periodo-box">
    Relatório referente às inscrições registadas entre
    <strong>{{ \Carbon\Carbon::parse($dataInicial)->format('d/m/Y') }}</strong>
    e
    <strong>{{ \Carbon\Carbon::parse($dataFinal)->format('d/m/Y') }}</strong>.
  </div>

  {{-- Resumo --}}
  <table class="stats">
    <tr>
      <td>
        <span class="num">{{ $registos->count() }}</span>
        <span class="label">Inscrições no período</span>
      </td>
      <td>
        <span class="num">{{ $registos->where('categoria', 'Advogado')->count() }}</span>
        <span class="label">Advogados</span>
      </td>
      <td>
        <span class="num">{{ $registos->where('categoria', 'Advogado Estagiário')->count() }}</span>
        <span class="label">Advogados estagiários</span>
      </td>
      <td>
        <span class="num">{{ $registos->where('situacao', 'ativa')->count() }}</span>
        <span class="label">Situação ativa</span>
      </td>
    </tr>
  </table>

  {{-- Tabela de registos --}}
  @if($registos->count() > 0)
    <table class="registos">
      <thead>
        <tr>
          <th class="num-col">Nº Cédula</th>
          <th>Nome completo</th>
          <th>Categoria</th>
          <th>Comarca / Foro</th>
          <th>Data de inscrição</th>
          <th>Situação</th>
        </tr>
      </thead>
      <tbody>
        @foreach($registos as $r)
          <tr>
            <td class="num-col">{{ $r->cedula }}</td>
            <td>{{ $r->nome }}</td>
            <td>
              <span class="badge {{ $r->categoria === 'Advogado' ? 'advogado' : 'estagiario' }}">
                {{ $r->categoria }}
              </span>
            </td>
            <td>{{ $r->comarca }}</td>
            <td>{{ \Carbon\Carbon::parse($r->data_inscricao)->format('d/m/Y') }}</td>
            <td>
              <span class="situacao {{ $r->situacao === 'ativa' ? 'ativa' : 'pendente' }}">
                <span class="dot"></span>{{ $r->situacao === 'ativa' ? 'Ativa' : 'Pendente' }}
              </span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p class="empty-state">Nenhuma inscrição encontrada para o intervalo selecionado.</p>
  @endif

  {{-- Bloco de assinatura / validação --}}
  <div class="assinatura">
    <table>
      <tr>
        <td style="width:50%; text-align:center;">
          <div class="linha"></div>
          <div class="legenda">Responsável pelo Registo</div>
        </td>
        <td style="width:50%; text-align:center;">
          <div class="linha"></div>
          <div class="legenda">Carimbo / Validação</div>
        </td>
      </tr>
    </table>
  </div>

</body>
</html>
