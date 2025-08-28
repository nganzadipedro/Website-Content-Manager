
function valida_formulario() {

  var msgErro = '';
  var tem = true;

  const name = document.getElementById('name').value;
  const subject = document.getElementById('subject').value;
  const message = document.getElementById('message').value;
  const file = document.getElementById('file').files[0];
  const tiposPermitidos = ['image/jpeg', 'image/png', 'application/pdf'];

  if (name == '' || name == null) {
    msgErro = "Digite o seu nome";
    tem = false;
  }
  else if (subject == '' || subject == null) {
    msgErro = "Digite o assunto da reclamação/denúncia";
    tem = false;
  }
  else if (message == '' || message == null) {
    msgErro = "Descreva a sua reclamação/denúncia";
    tem = false;
  }
  else if (file) {
    if (!tiposPermitidos.includes(file.type)) {
      msgErro = 'Formato de imagem inválido. Use JPG, PNG ou PDF.';
      tem = false;
    }
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

    const form = document.getElementById('complaintForm');
    const submitBtn = form.querySelector('.btn-submit');

    const formData = new FormData();

    const name = document.getElementById('name').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;
    const file = document.getElementById('file').files[0];

    formData.append('name', name);
    formData.append('subject', subject);
    formData.append('message', message);
    formData.append('file', file);

    Swal.fire({
      title: "Confirmação",
      text: "Tem certeza que deseja enviar esta denúncia/reclamação?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#34c38f",
      cancelButtonColor: "#f46a6a",
      confirmButtonText: "Enviar!",
      cancelButtonText: "Cancelar",
      showLoaderOnConfirm: true,
      preConfirm: function () {

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';

        return $.ajax({

          // url: "https://cpl.solucoesfirmes.tech/complaint/post",
          url: "/complaint/post",
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
                text: 'A sua denúncia/reclamação foi enviada com sucesso',
                timer: 4000
              });

              submitBtn.disabled = false;
              submitBtn.innerHTML = 'Enviar';

              setTimeout(() => {

                window.location.reload();

              }, 2000);

            }
          },
          error: function (error) {

            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Enviar';

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
