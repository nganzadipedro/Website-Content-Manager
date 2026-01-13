<style>
    .cabecalho {
        width: 90%;
        margin: 0 auto;
        background-color: white;
        color: #191970;
        padding: 1px;
        text-align: center;
        text-transform: uppercase;
        font-size: 24px;
        margin-top: 30px;
    }

    .imagens {
        width: 90%;
        padding: 1px;
    }

    .corpo {
        width: 90%;
        margin: 0 auto;
        margin-top: 30px;
    }

    .impar {
        background-color: #fff;
        color: black;
        padding: 5px;
    }

    .par {
        background-color: whitesmoke;
        color: black;
        padding: 5px;
    }

    .observacao {
        font-style: italic;
    }

    #img_1{
        position: relative;
        left: 50px;
    }
</style>

<div class="imagens">
    <img id="img_1" src="https://enoaa.cef-oaa.org/images/logo_enoaa_cor.png" alt="" width="120px" height="50px">
    <img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="50px" height="50px" align="right">
</div>
<div class="cabecalho">
    <h4>Exame Nacional de Acesso à Advocacia - {{ $ano_exame }} <br>
        Ficha do Candidato</h4>
</div>

<div class="corpo">

    <hr>
    <div class="par">
        <strong>ID-Inscrição:</strong> {{ $candidatura->codigo }}
    </div>
    <div class="impar">
        <strong>Nome Completo:</strong> {{ $candidato->getPessoa->nome }}
    </div>
    <div class="par">
        <strong>Documento de identificação:</strong> {{ $candidato->getPessoa->documento }}
    </div>
    <div class="impar">
        <strong>Nº Documento de identificação:</strong> {{ $candidato->getPessoa->num_documento }}
    </div>
    <div class="par">
        <strong>Nacionalidade:</strong> {{ $candidato->nacionalidade }}
    </div>
    <div class="impar">
        <strong>Naturalidade:</strong> {{ $candidato->naturalidade }}
    </div>
    <div class="par">
        <strong>Tem necessidade especial:</strong> {{ $candidato->necessidade_especial }}
    </div>
    <div class="impar">
        <strong> Género:</strong> {{ $candidato->getPessoa->genero }} <br>
    </div>
    <div class="par">
        <strong> Província:</strong> {{ $candidato->getProvincia->descricao }} <br>
    </div>
    <div class="impar">
        <strong> Município:</strong> {{ $candidato->municipio }} <br>
    </div>
    <div class="par">
        <strong> Endereço:</strong> {{ $candidato->endereco }} <br>
    </div>
    <div class="impar">
        <strong> Email:</strong> {{ $candidato->getPessoa->email }} <br>
    </div>
    <div class="par">
        <strong> Telefone principal:</strong> {{ $candidato->getPessoa->telefone1 }} <br>
    </div>
    <div class="impar">
        <strong> Telefone alternativo:</strong> {{ $candidato->getPessoa->telefone2 }} <br>
    </div>
    <div class="par">
        <strong> Instituição de Estudo:</strong> {{ $candidato->instituicao_estudo }} <br>
    </div>
    <div class="impar">
        <strong> Província onde pretende fazer o exame:</strong> {{ $candidato->getProvinciaExame->descricao }} <br>
    </div>
    <hr>
    <br>
    <label class="observacao">*Conserve esta ficha para efeito de eventuais reclamações e realização do EN-OAA.</label>

</div>