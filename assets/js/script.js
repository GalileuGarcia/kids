$('.datatable').DataTable({
    "paging": true,
    "ordering": false,
    "searching": true, // Oculta a função de pesquisa
    "info": true, // Oculta a exibição do número total de registros
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Exibir _MENU_ registros por página",
        "sZeroRecords": "Nenhum resultado encontrado",
        "sEmptyTable": "Nenhum resultado encontrado",
        "sInfo": "Exibindo do _START_ até _END_ de um total de _TOTAL_ registros",
        "sInfoEmpty": "Exibindo do 0 até 0 de um total de 0 registros",
        "sInfoFiltered": "(Filtrado de um total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Carregando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "<i class='fa-solid fa-circle-right'></i>",
            "sPrevious": "<i class='fa-solid fa-circle-left'></i>"
        },
        "oAria": {
            "sSortAscending": ": Ativar para ordenar a columna de maneira ascendente",
            "sSortDescending": ": Ativar para ordenar a columna de maneira descendente"
        }
    }
});
$('body').delegate('.btn-acessa-sistema', 'click', function (e) {
    e.preventDefault();
    window.location.href = 'cadastrar';
});
$(document).ready(function () {
    startWebcam();

    $('.telefone').mask('(00) 00000-0000');
    $('.idade').mask('00');
    $('#tags').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            };
        },
    });

    $('.single').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    var video = document.getElementById('videoElement');
    var canvas = document.getElementById('canvasElement');
    var context = canvas.getContext('2d');
    var openModalButton = document.getElementById('openModalButton');
    var captureButton = document.getElementById('captureButton');
    var saveButton = document.getElementById('saveButton');
    var modal = $('#webcamModal');

    // Adiciona um evento antes de abrir a tab
    $('#myTabs a').on('show.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // O destino da tab que será aberta
        $('#form-cadastro')[0].reset();
        $('#editar-form-cadastro')[0].reset();
        $('.box-img').css('display', 'none');
        $('.caixa').css('display', 'block');
        $('.canvasElement').css('display', 'none');
        $('input[name="id"]').val('');
        $('input[name="id_parentesco"]').val('');
    });
});

$('body').delegate('#openModalButton', 'click', function (e) {
    e.preventDefault();
    var modal = $('#webcamModal');
    modal.modal('show');
    startWebcam();
});
$('body').delegate('#captureButton', 'click', function (e) {
    e.preventDefault();
    var modal = $('#webcamModal');
    var canvas = document.getElementsByClassName('canvasElement')[0];
    var context = canvas.getContext('2d');
    var video = document.getElementsByClassName('videoElement')[0]
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    canvas.style.display = 'block';
    modal.modal('hide');
    $('.canvasElement').css('display', 'none');
    $('.caixa').css('display', 'none');
    $('.box-img').css('display', 'block');
    var dataURL = canvas.toDataURL('image/png');
    $("input[name='foto'").val(dataURL);
    $('.box-img').html('<img src="' + dataURL + '" style="width: 100%; border-radius: 10px; transform: scaleX(-1);" />');
});

$('body').delegate('#necessidades', 'change', function (e) {
    e.preventDefault();
    var valorSelecionado = $(this).val();
    if (valorSelecionado == "S") {
        $("input[name='descricao_necessidades'").removeAttr('disabled');
    } else {
        $("input[name='descricao_necessidades'").prop('disabled', true);
    }
});
$('body').delegate('#necessidades_alimenticias', 'change', function (e) {
    e.preventDefault();
    var valorSelecionado = $(this).val();
    if (valorSelecionado == "S") {
        $("input[name='descricao_necessidades_alimenticias'").removeAttr('disabled');
    } else {
        $("input[name='descricao_necessidades_alimenticias'").prop('disabled', true);
    }
});
$('body').delegate('#exclui-foto', 'click', function (e) {
    e.preventDefault();
    var canvas = document.getElementById('canvasElement');
    canvas.style.display = 'none';
    $('.box-img').css('display', 'none');
    $('.caixa').css('display', 'block');
    $("input[name='foto'").val('');
    $('.canvasElement').css('display', 'none');
});
$('body').delegate('.btn-exclui-crianca', 'click', function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var responsavel = $(this).attr("data-responsavel");

    Swal.fire({
        title: "Você deseja prosseguir?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "CONFIRMAR",
        denyButtonText: "CANCELAR"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'cadastrar/excluiCrianca',
                data: {id: id, responsavel: responsavel},
                dataType: 'json',
                success: function (data) {
                    if (data.status == false) {
                        Swal.fire(data.mensagem, "", "error");
                        return;
                    }

                    Swal.fire("Operação realizada com sucesso", "", "success");

                    setTimeout(function () {
                        window.location.reload();
                    }, 1300);
                },
                error: function (error) {
                    console.error('Erro na requisição AJAX', error);
                }
            });
        }
    });
});

$('body').delegate('#editar-form-cadastro', 'submit', function (e) {
    e.preventDefault();
    $.ajax({
        data: $("#editar-form-cadastro").serialize(),
        type: "POST",
        dataType: 'json',
        url: 'cadastrar/cadastraCrianca',
        success: function (data) {
            if (data.status == 'erro-form') {
                toastr.error(data.mensagem);
                return;
            }
            toastr.success(data.mensagem);
            setTimeout(function () {
                window.location = 'cadastrar';
            }, 1500);
        }
    });
});

$('body').delegate('#form-cadastro', 'submit', function (e) {
    e.preventDefault();
    $.ajax({
        data: $("#form-cadastro").serialize(),
        type: "POST",
        dataType: 'json',
        url: 'cadastrar/cadastraCrianca',
        success: function (data) {
            if (data.status == 'erro-form') {
                toastr.error(data.mensagem);
                return;
            }
            toastr.success(data.mensagem);
            setTimeout(function () {
                window.location = 'cadastrar';
            }, 1500);
        }
    });
});

function startWebcam() {
    var video = document.getElementById('videoElement');
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({video: {width: 1280, height: 720}})
                .then(function (stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function (error) {
                    console.error("Error accessing webcam: ", error);
                });
    } else {
        alert("WebRTC not supported in this browser.");
    }
}

$('body').delegate('.btn-editar', 'click', function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var id_responsavel = $(this).attr("data-responsavel");
    var idade = $(this).attr("data-idade");
    var sexo = $(this).attr("data-sexo");
    var necessidades = $(this).attr("data-necessidade");
    var alimenticias = $(this).attr("data-alimenticia");
    var parentesco = $(this).attr("data-parentesco");
    var telefone = $(this).attr("data-telefone");
    var img = $(this).attr("data-foto");
    var linha = $(this).closest('tr');
    $('input[name="id"]').val(id);
    $('input[name="id_parentesco"]').val(id_responsavel);
    $('input[name="nome"]').val(linha.find('td:eq(0)').text());
    $('input[name="nome_responsavel"]').val($(this).attr("data-nome_responsavel"));
    $('input[name="idade"]').val(idade);
    $('input[name="telefone"]').val(telefone);
    $('select[name="sexo"]').val(sexo);
    $('select[name="necessidades"]').val(necessidades);
    $('select[name="necessidades_alimenticias"]').val(alimenticias);
    $('select[name="parentesco"]').val(parentesco);
    $('input[name="foto"]').val(img);

    if (necessidades == "S") {
        $("input[name='descricao_necessidades'").removeAttr('disabled');
    } else {
        $("input[name='descricao_necessidades'").prop('disabled', true);
    }

    if (alimenticias == "S") {
        $("input[name='descricao_necessidades_alimenticias'").removeAttr('disabled');
    } else {
        $("input[name='descricao_necessidades_alimenticias'").prop('disabled', true);
    }
    $('.box-img').css('display', 'block');
    $('.caixa').css('display', 'none');

    $('.box-img').html('<img src="' + img + '" style="width: 100%; border-radius: 10px" />');

    $('#mdl_editar').modal('show');
});

$('body').delegate('#form-login', 'submit', function (e) {
    e.preventDefault();
    $.ajax({
        data: $("#form-login").serialize(),
        type: "POST",
        dataType: 'json',
        url: 'login/logar',
        success: function (data) {
            if (data.status == 'erro-form' || data.status == false) {
                toastr.error(data.mensagem);
                return;
            }
            toastr.success(data.mensagem);
            setTimeout(function () {
                window.location = 'painel';
            }, 1500);
        }
    });
});