<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<title>Relatório de Inscrições</title>
<style>
  /*
    Renderizado pelo DomPDF (barryvdh/laravel-dompdf).
    Sem flexbox/grid — layout em <table>.
    Paleta: apenas texto preto + tonalidades de amarelo.
    Espaço reservado no cabeçalho para o logotipo da instituição.
  */

  @page { margin: 90px 36px 70px 36px; }
  * { box-sizing: border-box; }

  body{
    font-family: "Helvetica", Arial, sans-serif;
    color:#141414;
    font-size: 10.5px;
    line-height:1.5;
  }

  /* ===== Cabeçalho fixo ===== */
  header{
    position: fixed;
    top: -70px; left: 0; right: 0;
    height: 70px;
  }
  .masthead{
    width:100%;
    border-collapse:collapse;
    border-bottom: 3px double #c99a2e;
    padding-bottom:10px;
  }
  .masthead td{ vertical-align:bottom; padding-bottom:10px; }
  .masthead .logo-slot{
    width:60px; height:48px;
    text-align:center; vertical-align:middle;
  }
  .masthead .logo-slot img{ max-width:60px; max-height:48px; }
  .masthead .titles{ padding-left:14px; }
  .masthead .eyebrow{
    margin:0 0 3px;
    text-transform:uppercase;
    letter-spacing:1.5px;
    font-size:8px;
    color:#8a6d1a;
  }
  .masthead h1{ margin:0; font-size:16px; color:#141414; }
  .masthead .org-name{
    text-align:right; font-size:9px; color:#141414; font-style:italic;
  }
  .masthead .org-name strong{
    display:block; font-style:normal; font-size:10.5px; color:#141414;
  }

  /* ===== Rodapé fixo ===== */
  footer{
    position: fixed;
    bottom: -60px; left: 0; right: 0;
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

  /* ===== Corpo ===== */
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

  h2.seccao{
    font-size:11.5px;
    text-transform:uppercase;
    letter-spacing:0.6px;
    color:#141414;
    border-bottom:1px solid #e8cf7d;
    padding-bottom:5px;
    margin:22px 0 10px;
  }

  /* Resumo geral (topo) — 4 colunas */
  table.stats{
    width:100%;
    border-collapse: separate;
    border-spacing: 8px 0;
    margin-bottom:6px;
  }
  table.stats td{
    width:25%;
    border:1px solid #e8cf7d;
    border-top:3px solid #c99a2e;
    padding:10px 12px;
    background:#fffdf5;
  }
  table.stats .num{ font-size:19px; font-weight:bold; color:#141414; display:block; }
  table.stats .label{
    font-size:7.5px; text-transform:uppercase; letter-spacing:0.5px;
    color:#141414; margin-top:4px; display:block;
  }

  /* Blocos de resumo de processos, por categoria */
  .categoria-bloco{
    border:1px solid #e8cf7d;
    margin-bottom:16px;
  }
  .categoria-bloco .categoria-header{
    background:#c99a2e;
    color:#141414;
    font-weight:bold;
    font-size:10px;
    text-transform:uppercase;
    letter-spacing:0.5px;
    padding:7px 12px;
  }
  table.categoria-metrics{
    width:100%;
    border-collapse:collapse;
  }
  table.categoria-metrics td{
    width:25%;
    padding:12px;
    text-align:center;
    border-right:1px solid #f0e2b0;
  }
  table.categoria-metrics td:last-child{ border-right:none; }
  table.categoria-metrics .num{
    font-size:20px;
    font-weight:bold;
    color:#141414;
    display:block;
  }
  table.categoria-metrics .label{
    font-size:7.5px;
    text-transform:uppercase;
    letter-spacing:0.4px;
    color:#141414;
    margin-top:4px;
    display:block;
  }
  table.categoria-metrics .total-col{ background:#fdf6de; }
  table.categoria-metrics .total-col .num{ font-size:22px; }

  /* Gráfico de barras comparativo (feito só com CSS, sem JS) */
  .chart-legend{ font-size:8.5px; margin-bottom:10px; color:#141414; }
  .chart-legend .swatch{
    display:inline-block;
    width:10px; height:10px;
    margin-right:4px;
    vertical-align:middle;
  }
  .chart-legend .swatch.adv{ background:#b8860b; }
  .chart-legend .swatch.est{ background:#f0c419; border:1px solid #b8860b; }
  .chart-legend .item{ margin-right:18px; }

  table.bar-chart{ width:100%; border-collapse:collapse; margin-bottom:8px; }
  table.bar-chart td.metric-label{
    font-size:9px;
    font-weight:bold;
    padding:10px 0 5px;
    border-top:1px solid #f0e2b0;
    color:#141414;
  }
  table.bar-chart tr.bar-row td{ padding:2px 0; vertical-align:middle; }
  table.bar-chart tr.bar-row td.bar-name{
    width:110px;
    font-size:8.5px;
    padding-right:8px;
    color:#141414;
  }
  table.bar-chart tr.bar-row td.bar-track{
    background:#fdf6de;
    border:1px solid #f0e2b0;
    height:14px;
  }
  table.bar-chart tr.bar-row td.bar-value{
    width:34px;
    text-align:right;
    font-size:8.5px;
    font-weight:bold;
    padding-left:8px;
    color:#141414;
  }
  .bar-fill{ height:14px; }
  .bar-fill.adv{ background:#b8860b; }
  .bar-fill.est{ background:#f0c419; border-right:1px solid #b8860b; }

  /* Bloco de assinatura / validação */
  .assinatura{ margin-top:46px; width:100%; }
  .assinatura table{ width:100%; }
  .assinatura .linha{ border-top:1px solid #141414; width:70%; margin:34px auto 4px; }
  .assinatura .legenda{ text-align:center; font-size:9px; color:#141414; }
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
        <td style="text-align:left;">Documento gerado em {{ $geradoEm }}</td>
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

  {{-- Resumo geral de inscrições --}}
  <table class="stats">
    <tr>
      <td>
        <span class="num">{{ $totalInscricoes }}</span>
        <span class="label">Inscrições no período</span>
      </td>
      <td>
        <span class="num">{{ $totalAdvogados }}</span>
        <span class="label">Advogados</span>
      </td>
      <td>
        <span class="num">{{ $totalEstagiarios }}</span>
        <span class="label">Advogados estagiários</span>
      </td>
      <td>
        <span class="num">{{ $totalAtivas }}</span>
        <span class="label">Situação ativa</span>
      </td>
    </tr>
  </table>

  <h2 class="seccao">Resumo de Processos por Categoria</h2>

  {{-- Bloco: Advogados --}}
  <div class="categoria-bloco">
    <div class="categoria-header">Advogados</div>
    <table class="categoria-metrics">
      <tr>
        <td>
          <span class="num">{{ $processosAdvogados['pendentes'] ?? 0 }}</span>
          <span class="label">Pendentes</span>
        </td>
        <td>
          <span class="num">{{ $processosAdvogados['execucao'] ?? 0 }}</span>
          <span class="label">Em execução</span>
        </td>
        <td>
          <span class="num">{{ $processosAdvogados['concluidos'] ?? 0 }}</span>
          <span class="label">Concluídos</span>
        </td>
        <td class="total-col">
          <span class="num">{{ $processosAdvogados['total'] ?? 0 }}</span>
          <span class="label">Total de processos</span>
        </td>
      </tr>
    </table>
  </div>

  {{-- Bloco: Advogados Estagiários --}}
  <div class="categoria-bloco">
    <div class="categoria-header">Advogados Estagiários</div>
    <table class="categoria-metrics">
      <tr>
        <td>
          <span class="num">{{ $processosEstagiarios['pendentes'] ?? 0 }}</span>
          <span class="label">Pendentes</span>
        </td>
        <td>
          <span class="num">{{ $processosEstagiarios['execucao'] ?? 0 }}</span>
          <span class="label">Em execução</span>
        </td>
        <td>
          <span class="num">{{ $processosEstagiarios['concluidos'] ?? 0 }}</span>
          <span class="label">Concluídos</span>
        </td>
        <td class="total-col">
          <span class="num">{{ $processosEstagiarios['total'] ?? 0 }}</span>
          <span class="label">Total de processos</span>
        </td>
      </tr>
    </table>
  </div>

  <h2 class="seccao">Comparativo: Advogados vs. Advogados Estagiários</h2>

  @php
    $metricas = [
      'pendentes'  => ['label' => 'Pendentes',          'adv' => $processosAdvogados['pendentes']  ?? 0, 'est' => $processosEstagiarios['pendentes']  ?? 0],
      'execucao'   => ['label' => 'Em Execução',         'adv' => $processosAdvogados['execucao']   ?? 0, 'est' => $processosEstagiarios['execucao']   ?? 0],
      'concluidos' => ['label' => 'Concluídos',          'adv' => $processosAdvogados['concluidos'] ?? 0, 'est' => $processosEstagiarios['concluidos'] ?? 0],
      'total'      => ['label' => 'Total de Processos',  'adv' => $processosAdvogados['total']      ?? 0, 'est' => $processosEstagiarios['total']      ?? 0],
    ];
  @endphp

  <div class="chart-legend">
    <span class="item"><span class="swatch adv"></span>Advogados</span>
    <span class="item"><span class="swatch est"></span>Advogados Estagiários</span>
  </div>

  <table class="bar-chart">
    @foreach($metricas as $m)
      @php
        $max = max($m['adv'], $m['est'], 1);
        $advPct = max(round(($m['adv'] / $max) * 100), $m['adv'] > 0 ? 3 : 0);
        $estPct = max(round(($m['est'] / $max) * 100), $m['est'] > 0 ? 3 : 0);
      @endphp
      <tr>
        <td class="metric-label" colspan="3">{{ $m['label'] }}</td>
      </tr>
      <tr class="bar-row">
        <td class="bar-name">Advogados</td>
        <td class="bar-track"><div class="bar-fill adv" style="width:{{ $advPct }}%;"></div></td>
        <td class="bar-value">{{ $m['adv'] }}</td>
      </tr>
      <tr class="bar-row">
        <td class="bar-name">Advogados Estagiários</td>
        <td class="bar-track"><div class="bar-fill est" style="width:{{ $estPct }}%;"></div></td>
        <td class="bar-value">{{ $m['est'] }}</td>
      </tr>
    @endforeach
  </table>

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