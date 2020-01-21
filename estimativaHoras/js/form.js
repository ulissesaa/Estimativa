function onSelectTecnologia(codTecnologia) {
    $.ajax({
        type: 'GET',
        url: '../php/api/GetObjetoPorTecnologia.php',
        data: {
            codTecnologia: codTecnologia
        },
        dataType: 'json',
        beforeSend: function () {
            document.getElementById("btnTipoObjeto").innerText = "Carregando...";
            document.getElementById("btnTipoObjeto").style.backgroundColor = "#dadada";
            $("#menuObjetos").empty();
        },
        success: function (result) {
            if (!result.error) {
                $.each(result, function (index, linha) {

                    var li = '<li role="presentation" style="position:relative;width:100%;">' +
                        '<a onclick="selectObjeto(' + linha.codigo + ',' + 'this.innerText' + ')" class="dropdown-item" >' + linha.descricao + '</a>' +
                        '</li>';
                    $('#menuObjetos').append(li);
                });
                document.getElementById("btnTipoObjeto").innerText = "Escolha uma opção";
            } else {
                document.getElementById("btnTipoObjeto").innerText = "Vazio";
            }
        },
        error(a) {
            console.log(a);
            alert("Erro na busca pelos objetos desta tecnologia!");
        }
    })
}

function GerarPDF(id){
    window.open('../pdf/GerarPDF.php?cod='+id);
    window.location.reload();
    
}

function selectObjeto(codigo, nome) {

    document.getElementById('btnTipoObjeto').innerHTML = nome;
    document.getElementById('btnTipoObjeto').style.backgroundColor = "#ec0c0c";
    document.getElementById('btnTipoObjeto').value = codigo;
}

function selectNivel(codigo, nome) {
    document.getElementById('btnNivelComplexidade').innerHTML = nome;
    document.getElementById('btnNivelComplexidade').style.backgroundColor = "#ec0c0c";
    document.getElementById('btnNivelComplexidade').value = codigo;
}

function selectTecnologia(codigo, nome) {
    document.getElementById('btnTecnologia').innerHTML = nome;
    document.getElementById('btnTecnologia').style.backgroundColor = "#ec0c0c";
    onSelectTecnologia(codigo);
    document.getElementById('btnTecnologia').value = codigo;

}

function selectOrigemObjeto(codigo, nome) {
    document.getElementById('btnOrigemObjeto').innerHTML = nome;
    document.getElementById('btnOrigemObjeto').style.backgroundColor = "#ec0c0c";
    document.getElementById('btnOrigemObjeto').value = codigo;
}

function validarInserir() {
    var objeto = document.getElementById('btnTipoObjeto').value;
    var complexidade = document.getElementById('btnNivelComplexidade').value;
    var origem = document.getElementById('btnOrigemObjeto').value;
    var tecnologia = document.getElementById('btnTecnologia').value;

    if (tecnologia != 0 && objeto != 0 && complexidade != 0 && origem != 0 && document.getElementById("txtDescricao").value != "" && document.getElementById("txtComplexidade").value != "") {
        InserirLinha(objeto, origem, complexidade);
    } else {
       $("#modalAlert").find("h4").text("Preencha todos os campos!");
       $("#modalAlert").modal("show");
    }

}

function GravarPagina() {

        var chamado = $("#chamado").val();
        var descricao = $("#descricao").val();
        var projeto = $("#projeto").val();
        var dataCriacao = $("#dataCriacao").val();
        var responsavel = $("#responsavel").val();

        if (chamado.trim().length == 0 || descricao.trim().length == 0 || projeto.trim().length == 0 || responsavel.trim().length == 0) {
           $("#modalAlert").find("h4").text("Preencha todos os campos do cabeçalho!");
           $("#modalAlert").modal("show");
            return;
        }
        if(LinhasLista.length == 0){
            $("#modalAlert").find("h4").text("Nenhum objeto adicionado!");
            $("#modalAlert").modal("show");
            return;
        }

        var cabecalho = {
        chamado: chamado,
        descricao: descricao,
        projeto: projeto,
        dataCriacao: dataCriacao,
        responsavel: responsavel
        }
        $.ajax({
            type: 'POST',
            url: '../php/api/GravarCabecalho.php',
            data: {chamado: cabecalho, Linhas: LinhasLista},
            dataType: 'json',
            cache: false,
            beforeSend: function(){
                $("#modalLoading").modal("show");
            },
            success: function (res) {
                $("#modalLoading").modal("hide");
                
                if (res.error) {
                    $("#modalFail").find("h4").text(res.msg);
                    $("#modalFail").modal("show");
                }
                else {
                    $("#btnPdf").val(res.cod);
                    $("#modalOk").find("h4").text(res.msg);
                    $("#modalOk").modal("show");
                }
            },
            error(a) {
                console.log(a);
                $("#modalLoading").modal("hide");
                $("#modalFail").find("h4").text("Erro!");
                $("#modalFail").modal("show");
                return;
            }
        });


}

$(document).ready(function () {
    $("#chamado").on('keyup', function () {

        $(this).val(this.value.replace(/\D/g, ''));
    });
});