
$(document).on('click', '.btn-edit', function (e) {

    e.preventDefault(); // se for link, evita redirecionamento
    const id = $(this).data('id'); // forma jQuery de pegar data-id
    
    window.location.href = '/system/admin/edit-data/member/' + id;

});
