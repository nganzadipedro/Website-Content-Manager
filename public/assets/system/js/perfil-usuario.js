
function actualizaSenha() {

    var antiga = $("#senha_antiga").val();
    var nova = $("#nova").val();

    var form = new FormData();

    form.append('antiga', antiga);
    form.append('nova', nova);

    Swal.fire({
        title: "Tem certeza que pretende actualizar a sua senha?",
        text: "",
        icon: "warning",
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Actualizar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $(".swal2-cancel").hide();
            return $.ajax({
                url: "/alterar/senha",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (res) {

                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "",
                            text: 'A sua senha foi actualizada com sucesso.',
                            timer: 5000
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 5000);
                    }
                    else if (res == 'seguranca') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'A senha informada não obedece os requisitos pedidos',
                            timer: 4000
                        });
                    }
                    else if (res == 'incorrecta') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'A senha antiga está incorrecta',
                            timer: 4000
                        });
                    }
                },
                error: function (error) {
                    console.log("Error: " + error);

                }
            });
        }
    });


}

$("#btn-update-foto").click(function () {

  var foto = document.getElementById('fotografia').value;

  if(foto == null || foto == ''){
    sweetAlert({
        type: "warning",
        title: "Aviso!",
        text: 'Carregue a sua foto de perfil',
        timer: 4000
    });
  }
  else{
   
    var fotografia = $("#fotografia")[0].files[0];
    var form = new FormData();

    form.append('fotografia', fotografia);

    Swal.fire({
        title: "Tem certeza que pretende actualizar a sua foto de perfil?",
        text: "",
        icon: "warning",
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Actualizar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $(".swal2-cancel").hide();
            return $.ajax({
                url: "/alterar/foto",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (res) {

                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "",
                            text: 'Foto de perfil actualizado com sucesso',
                            timer: 4000
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 4000);
                    }
                   
                },
                error: function (error) {
                    sweetAlert({
                        type: "warning",
                        title: "Aviso!",
                        text: 'Verifique se a foto de perfil está em formato .PNG',
                        timer: 6000
                    });
                    console.log("Error: " + error);

                }
            });
        }
    });


  }

    
});


$("#btn-update-senha").click(function () {

    // valida o formulário
    if (validaForm1() == true) {

        // faz a inscrição
        actualizaSenha();

    }
});

// validação de formulário

function validaForm1() {

    var senha_antiga = document.getElementById('senha_antiga').value;
    var nova_senha = document.getElementById('nova').value;
    var confirmar = document.getElementById('confirmar').value;

    var msgErro = '';
    var tem = true;

    var re = /\S+@\S+\.\S+/;

    if (senha_antiga == '' || senha_antiga == null) {
        tem = false;
        msgErro = 'Digite a senha antiga';
    }
    else if (nova_senha == '' || nova_senha == null) {
        tem = false;
        msgErro = 'Digite a nova senha';
    }
    else if (nova_senha.length < 8) {
        tem = false;
        msgErro = 'A nova senha deve ter pelo menos 8 caracteres';
    }
    else if (confirmar == '' || confirmar == null) {
        tem = false;
        msgErro = 'Confirme a nova senha';
    }
    else if (nova_senha != confirmar) {
        tem = false;
        msgErro = 'A nova senha não foi confirmada';
    }

    if (tem == false) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: msgErro,
            timer: 4000
        });

    }

    return tem;
}


