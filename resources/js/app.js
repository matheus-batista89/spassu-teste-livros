import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    // Configuração de idioma em português
    const languagePtBr = {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
    };

    // Inicializar DataTable apenas se a tabela existir
    if ($('#tabela-assuntos').length) {
        $('#tabela-assuntos').DataTable({
            language: languagePtBr,
            pageLength: 10,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: -1 }
            ]
        });
    }

    if ($('#tabela-autores').length) {
        $('#tabela-autores').DataTable({
            language: languagePtBr,
            pageLength: 10,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: -1 }
            ]
        });
    }

    if ($('#tabela-livros').length) {
        $('#tabela-livros').DataTable({
            language: languagePtBr,
            pageLength: 10,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: -1 }
            ]
        });
    }

    document.getElementById('valor').addEventListener('input', function (e) {
        let valor = e.target.value;
        valor = valor.replace(/\D/g, '');
        if (valor != '') {
            valor = (parseInt(valor, 10) / 100).toFixed(2);
            valor = valor.replace('.', ',');
            valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
        e.target.value = valor;
    });

    document.getElementById('anoPublicacao').addEventListener('input', function (e) {
        let valor = e.target.value;
        valor = valor.replace(/\D/g, '');
        if (valor.length > 4) {
            valor = valor.slice(0, 4);
        }
        e.target.value = valor;
        const anoAtual = new Date().getFullYear();
        if (valor && parseInt(valor) > anoAtual) {
            this.setCustomValidity(`O ano não pode ser maior que ${anoAtual}.`);
            this.reportValidity();
        } else {
            this.setCustomValidity('');
        }
    });

    document.getElementById('edicao').addEventListener('input', function (e) {
        let valor = e.target.value;
        valor = valor.replace(/\D/g, '');
        if (valor.length > 10) {
            valor = valor.slice(0, 10);
        }
        e.target.value = valor;
    });

    $('.select2').select2({
        theme: 'bootstrap-5',
        placeholder: 'Selecione uma opção',
        width: '100%'
    });
});