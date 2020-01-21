function onSelectTecnologia(codTecnologia) {
    document.getElementById("novo").reset();
    document.getElementById("modificacao").reset();
    $("#btnGravar").attr("disabled", "disabled");
    $("#btnAtualizar").attr("disabled", "disabled");
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
            $("#modalFailTitle").text('Erro ao procurar objeto!');
            $("#modalFail").modal('show');
        }
    })
}

function onSelectObjeto(CodObjeto) {
    document.getElementById("novo").reset();
    document.getElementById("modificacao").reset();
    $.ajax({
        type: 'POST',
        url: '../php/api/GetTodasHorasObjeto.php',
        data: {
            cod: CodObjeto
        },
        dataType: 'json',
        beforeSend: function () {
            $("#modalLoading").modal("show");
        },
        success: function (res) {
            $("#modalLoading").modal("hide");
            if (res.error) {
                console.log('O objeto possui menos de 10 linhas!');
            } else if (res.cod == 1) {
                $("#btnAtualizar").attr("disabled", "disabled");
                $("#btnGravar").removeAttr('disabled');
            } else {
                PreencherInputs(res);
                $("#btnGravar").attr("disabled", "disabled");
                $("#btnAtualizar").removeAttr('disabled');
            }
        },
        error(a) {
            console.log(a.responseText);
        }

    })

}

function PreencherInputs(res) {
    $.each(res, function (index, obj) {

        if (obj.origemObjeto == 1) {
            if (obj.nivelComplexidade == 1) {
                $("#nmbanalise").val(parseInt(obj.analiseViabilidade));
                $("#nmbespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#nmbcodificacao").val(parseInt(obj.codificacao));
                $("#nmbtestes").val(parseInt(obj.teste));
                $("#nmbtotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));
            } else if (obj.nivelComplexidade == 2) {
                $("#nbanalise").val(parseInt(obj.analiseViabilidade));
                $("#nbespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#nbcodificacao").val(parseInt(obj.codificacao));
                $("#nbtestes").val(parseInt(obj.teste));
                $("#nbtotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 3) {
                $("#nmanalise").val(parseInt(obj.analiseViabilidade));
                $("#nmespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#nmcodificacao").val(parseInt(obj.codificacao));
                $("#nmtestes").val(parseInt(obj.teste));
                $("#nmtotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 4) {
                $("#naanalise").val(parseInt(obj.analiseViabilidade));
                $("#naespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#nacodificacao").val(parseInt(obj.codificacao));
                $("#natestes").val(parseInt(obj.teste));
                $("#natotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 5) {
                $("#nmaanalise").val(parseInt(obj.analiseViabilidade));
                $("#nmaespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#nmacodificacao").val(parseInt(obj.codificacao));
                $("#nmatestes").val(parseInt(obj.teste));
                $("#nmatotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            }
        } else if (obj.origemObjeto == 2) {
            if (obj.nivelComplexidade == 1) {
                $("#mmbanalise").val(parseInt(obj.analiseViabilidade));
                $("#mmbespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#mmbcodificacao").val(parseInt(obj.codificacao));
                $("#mmbtestes").val(parseInt(obj.teste));
                $("#mmbtotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 2) {
                $("#mbanalise").val(parseInt(obj.analiseViabilidade));
                $("#mbespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#mbcodificacao").val(parseInt(obj.codificacao));
                $("#mbtestes").val(parseInt(obj.teste));
                $("#mbtotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 3) {
                $("#mmanalise").val(parseInt(obj.analiseViabilidade));
                $("#mmespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#mmcodificacao").val(parseInt(obj.codificacao));
                $("#mmtestes").val(parseInt(obj.teste));
                $("#mmtotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 4) {
                $("#maanalise").val(parseInt(obj.analiseViabilidade));
                $("#maespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#macodificacao").val(parseInt(obj.codificacao));
                $("#matestes").val(parseInt(obj.teste));
                $("#matotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            } else if (obj.nivelComplexidade == 5) {
                $("#mmaanalise").val(parseInt(obj.analiseViabilidade));
                $("#mmaespecificacao").val(parseInt(obj.especificacaoTecnica));
                $("#mmacodificacao").val(parseInt(obj.codificacao));
                $("#mmatestes").val(parseInt(obj.teste));
                $("#mmatotal").val(parseInt(obj.analiseViabilidade) + parseInt(obj.especificacaoTecnica) + parseInt(obj.codificacao) + parseInt(obj.teste));

            }
        }

    });
}

function selectObjeto(codigo, nome) {

    document.getElementById('btnTipoObjeto').innerHTML = nome;
    document.getElementById('btnTipoObjeto').style.backgroundColor = "#ec0c0c";
    document.getElementById('btnTipoObjeto').value = codigo;
    onSelectObjeto(codigo);
}

function selectTecnologia(codigo, nome) {
    document.getElementById('btnTecnologia').innerHTML = nome;
    document.getElementById('btnTecnologia').style.backgroundColor = "#ec0c0c";
    onSelectTecnologia(codigo);
    document.getElementById('btnTecnologia').value = codigo;

}

$(function () {
    $("#gravarTecnologia").click(function (e) {
        e.preventDefault();
        var descricao = $("#txtDescricaoTecnologia").val().toUpperCase();

        if (descricao.trim().length == 0) {
            $("#modalFail").find("h4").text("Preencha a descrição!");
            $("#modalFail").modal("show");
            return false;
        }


        var formData = new FormData();
        formData.append('descricao', descricao);
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '../php/api/gravarTecnologia.php',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#modalLoading").modal("show");
            },
            success: function (res) {
                $("#modalLoading").modal("hide");
                
                if (res.error) {
                    console.log(res.msg);
                } else {
                    $("#modalOk").find("h4").text(res.msg);
                    $("#modalOk").modal('show');
                    var linha = '<li role="presentation" style="position:relative;width:100%;">' +
                        '<a onclick="selectTecnologia(' + res.codigo + ',' + 'this.innerText' + ')" class=dropdown-item >' + descricao + '</a>' +
                        '</li>';
                    $('#menuTecnologia').append(linha);
                    window.location.reload();
                    document.getElementById('txtDescricaoTecnologia').value = ("");
                }

            },
            error(a) {
                console.log(a);
            },

        });

    });
});

$(function () {
    $("#gravarObjeto").click(function (e) {
        e.preventDefault();
        var descricao = $("#txtDescricaoObjeto").val().toUpperCase();
        var codTecnologia = $("#btnTecnologia").val();

        if (descricao.trim().length == 0) {
            $("#modalFail").find("h4").text("Preencha a descrição!");
            $("#modalFail").modal("show");
            return false;
        } else if (codTecnologia == 0) {
            $("#modalFail").find("h4").text("Escolha a tecnologia!");
            $("#modalFail").modal("show");
        }
        var formData = new FormData();
        formData.append('descricao', descricao);
        formData.append('codTecnologia', codTecnologia);
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '../php/api/gravarObjeto.php',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#modalLoading").modal("show");
            },
            success: function (res) {
                $("#modalLoading").modal("hide");
                data = res;
                if (data.error) {
                    $("#modalFail").find("h4").text(data.msg);
                    $("#modalFail").modal("show");
                } else {
                    $("#modalOk").find("h4").text(data.msg);
                    $("#modalOk").modal("show");
                    $("#btnTipoObjeto").text("Escolha uma opção");
                    var linha = '<li role="presentation" style="position:relative;width:100%;">' +
                        '<a onclick="selectObjeto(' + data.codigo + ',' + 'this.innerText' + ')" class=dropdown-item >' + descricao + '</a>' +
                        '</li>';
        
                    $('#menuObjetos').append(linha);
                    document.getElementById('txtDescricaoObjeto').value = ("");
                    selectObjeto(res.codigo, descricao);

                }
            },
            error(a) {
                console.log(a);
            }

        });

    });
});

function limparCampos() {
    $("#menuObjetos").empty();

    document.getElementById('btnTecnologia').innerHTML = ("Escolha uma opção");
    document.getElementById('btnTipoObjeto').innerHTML = ("Selecione uma tecnologia");
    document.getElementById('btnTecnologia').value = 0;
    document.getElementById('btnTipoObjeto').value = 0;
    document.getElementById("btnTecnologia").style.backgroundColor = "#dadada";
    document.getElementById("btnTipoObjeto").style.backgroundColor = "#dadada";
}

var Lista = [];

function GravarHorasObjeto() {

    GerarLista();
    $.ajax({
        type: 'POST',
        url: '../php/api/GravarTodasHorasObjeto.php',
        data: {
            horas: Lista
        },
        dataType: 'json',
        beforeSend: function () {
            $("#modalLoading").modal("show");
        },
        success: function (res) {
            $("#modalLoading").modal("hide");
            if (res.error) {
                $("#modalFail").find("h4").text(res.msg);
                $("#modalFail").modal("show");
            } else {
                $("#modalOk").find("h4").text(res.msg);
                $("#modalOk").modal("show");
                limparCampos();
                document.getElementById("novo").reset();
                document.getElementById("modificacao").reset();
                $("#btnGravar").attr("disabled", "disabled");
            }
        },
        error(a, p) {
            console.log(a);
            console.log(p);

        }
    })

}

function AtualizarHorasObjeto() {

    GerarLista();
    $.ajax({
        type: 'POST',
        url: '../php/api/UpdateHorasObjeto.php',
        data: {
            lista: Lista
        },
        dataType: 'json',
        beforeSend: function () {
            $("#modalLoading").modal("show");
        },
        success: function (res) {
            $("#modalLoading").modal("hide");
            if (res.error) {
                $("#modalFail").find("h4").text(res.msg);
                $("#modalFail").modal("show");
            } else {
                $("#modalOk").find("h4").text(res.msg);
                $("#modalOk").modal("show");
                limparCampos();
                document.getElementById("novo").reset();
                document.getElementById("modificacao").reset();
                $("#btnAtualizar").attr("disabled", "disabled");
            }
        },
        error(a, p) {
            console.log(a);
            console.log(p);

        }
    })
}

function GerarLista() {

    Lista = [
        //----------NOVO        
        {
            origemObjeto: 1,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 1,
            analiseViabilidade: parseInt($("#nmbanalise").val()),
            especificacao: parseInt($("#nmbespecificacao").val()),
            codificacao: parseInt($("#nmbcodificacao").val()),
            teste: parseInt($("#nmbtestes").val())
        },
        {
            origemObjeto: 1,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 2,
            analiseViabilidade: parseInt($("#nbanalise").val()),
            especificacao: parseInt($("#nbespecificacao").val()),
            codificacao: parseInt($("#nbcodificacao").val()),
            teste: parseInt($("#nbtestes").val())
        },
        {
            origemObjeto: 1,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 3,
            analiseViabilidade: parseInt($("#nmanalise").val()),
            especificacao: parseInt($("#nmespecificacao").val()),
            codificacao: parseInt($("#nmcodificacao").val()),
            teste: parseInt($("#nmtestes").val())
        },
        {
            origemObjeto: 1,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 4,
            analiseViabilidade: parseInt($("#naanalise").val()),
            especificacao: parseInt($("#naespecificacao").val()),
            codificacao: parseInt($("#nacodificacao").val()),
            teste: parseInt($("#natestes").val())
        },
        {
            origemObjeto: 1,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 5,
            analiseViabilidade: parseInt($("#nmaanalise").val()),
            especificacao: parseInt($("#nmaespecificacao").val()),
            codificacao: parseInt($("#nmacodificacao").val()),
            teste: parseInt($("#nmatestes").val())
        },
        //----------MODIFICAÇÃO
        {
            origemObjeto: 2,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 1,
            analiseViabilidade: parseInt($("#mmbanalise").val()),
            especificacao: parseInt($("#mmbespecificacao").val()),
            codificacao: parseInt($("#mmbcodificacao").val()),
            teste: parseInt($("#mmbtestes").val())
        },
        {
            origemObjeto: 2,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 2,
            analiseViabilidade: parseInt($("#mbanalise").val()),
            especificacao: parseInt($("#mbespecificacao").val()),
            codificacao: parseInt($("#mbcodificacao").val()),
            teste: parseInt($("#mbtestes").val())
        },
        {
            origemObjeto: 2,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 3,
            analiseViabilidade: parseInt($("#mmanalise").val()),
            especificacao: parseInt($("#mmespecificacao").val()),
            codificacao: parseInt($("#mmcodificacao").val()),
            teste: parseInt($("#mmtestes").val())
        },
        {
            origemObjeto: 2,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 4,
            analiseViabilidade: parseInt($("#maanalise").val()),
            especificacao: parseInt($("#maespecificacao").val()),
            codificacao: parseInt($("#macodificacao").val()),
            teste: parseInt($("#matestes").val())
        },
        {
            origemObjeto: 2,
            tipoDesenvolvimento: parseInt($("#btnTipoObjeto").val()),
            nivelComplexidade: 5,
            analiseViabilidade: parseInt($("#mmaanalise").val()),
            especificacao: parseInt($("#mmaespecificacao").val()),
            codificacao: parseInt($("#mmacodificacao").val()),
            teste: parseInt($("#mmatestes").val())
        },

    ]

}