// ao clicar no botão de fechar, recarrega a página
$(".close").click(function () {
    window.location.reload();
});

// características para as modais de editar
$("#editModal").modal({
    backdrop: "static",
    keyboard: true,
    show: false
});

// janela para mensagem de confirmação
function sweetAlert(params) {
    Swal.fire({
        title: params.title,
        text: params.text,
        icon: params.type,
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: params.timer,
        timerProgressBar: true,
    });
}

// janela para mensagem de validação de formulário
function callToast(params) {
    Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    }).fire({
        icon: params.type,
        title: params.message
    });
}