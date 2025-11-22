$(document).ready(function () {
    console.log("App JS carregado com sucesso!");

    $('.btn-editar').on('click', function () {
        const id = $(this).data('id');
        const titulo = $(this).data('titulo');
        const descricao = $(this).data('descricao');
        const status = $(this).data('status');

        $('#edit-id').val(id);
        $('#edit-titulo').val(titulo);
        $('#edit-descricao').val(descricao);
        $('#edit-status').val(status);

        const modal = new bootstrap.Modal(document.getElementById('modalEditarTarefa'));
        modal.show();
    });

});
