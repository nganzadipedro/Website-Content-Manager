
function valida_formulario() {

  var msgErro = '';
  var tem = true;

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const subject = document.getElementById('subject').value;
  const senderType = document.getElementById('senderType').value;
  const identification = document.getElementById('identification').value;
  const message = document.getElementById('message').value;

  if (name == '' || name == null) {
    msgErro = "Digite o seu nome";
    tem = false;
  }
  else if (email == '' || email == null) {
    msgErro = "Digite o seu email";
    tem = false;
  }
  else if (subject == '' || subject == null) {
    msgErro = "Digite o assunto";
    tem = false;
  }
  else if (senderType == '' || senderType == null) {
    msgErro = "Escolha o tipo de remetente";
    tem = false;
  }
  else if (senderType == 'advogado' && (identification == '' || identification == null)) {
    msgErro = "Digite o Nº da Cédula de Advogado";
    tem = false;
  }
  else if (senderType == 'particular' && (identification == '' || identification == null)) {
    msgErro = "Digite o Nº do Bilhete de Identidade";
    tem = false;
  }
  else if (message == '' || message == null) {
    msgErro = "Digite o conteúdo da mensagem a ser enviada";
    tem = false;
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

document.getElementById('btn-save').addEventListener('click', function () {


  if (valida_formulario() === true) {

    const formData = new FormData();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const subject = document.getElementById('subject').value;
    const senderType = document.getElementById('senderType').value;
    const identification = document.getElementById('identification').value;
    const message = document.getElementById('message').value;

    formData.append('name', name);
    formData.append('subject', subject);
    formData.append('message', message);
    formData.append('email', email);
    formData.append('senderType', senderType);
    formData.append('identification', identification);

    Swal.fire({
      title: "Confirmação",
      text: "Tem certeza que deseja enviar esta mensagem de contacto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#34c38f",
      cancelButtonColor: "#f46a6a",
      confirmButtonText: "Enviar!",
      cancelButtonText: "Cancelar",
      showLoaderOnConfirm: true,
      preConfirm: function () {

        return $.ajax({
          url: "https://cpl.solucoesfirmes.tech/system/admin/message/post",
          headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
          },
          type: "POST",
          cache: false,
          contentType: false,
          processData: false,
          data: formData,
          success: function (res) {

            console.log(res);
            if (res == 'sucesso') {

              sweetAlert({
                type: "success",
                title: "Sucesso",
                text: 'A sua mensagem de contacto foi enviada com sucesso',
                timer: 4000
              });

              window.location.reload();

            }
          },
          error: function (error) {

            sweetAlert({
              type: "warning",
              title: "Erro " + error.status,
              text: 'Erro: ' + error.responseJSON.message,
              timer: 9000
            });
            console.log("Error: " + error.responseJSON.message);
          }
        });
      }
    });

  }

});
