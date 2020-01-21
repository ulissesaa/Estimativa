var LinhasLista = [];
var row = 0;

function InserirLinha(tipoDesenvolvimento, origemObjeto, nivelComplexidade) {
    row++;
    $("#modalLoading").modal("show");
    $.getJSON('../php/api/GetHorasObjeto.php?tipoDesenvolvimento=' +
        tipoDesenvolvimento + '&origemObjeto=' + origemObjeto + '&nivelComplexidade=' + nivelComplexidade,
        function (result) {
            $("#modalLoading").modal("hide");
            if (!result.error) {
                $.each(result, function (index, linha) {
                    var total = parseInt(linha.analiseViabilidade) + parseInt(linha.especificacaoTecnica) + parseInt(linha.codificacao) + parseInt(linha.teste);
                    var Linhaobj = {
                        OrigemObjeto: origemObjeto,
                        TipoDesenvolvimento: tipoDesenvolvimento,
                        NivelComplexidade: nivelComplexidade,
                        AnaliseViabilidade: linha.analiseViabilidade,
                        EspecificacaoTecnica: linha.especificacaoTecnica,
                        Codificacao: linha.codificacao,
                        Testes: linha.teste,
                        Descricao: $("#txtDescricao").val(),
                        CriteriosComplexidade: $("#txtComplexidade").val()
                    };

                    LinhasLista.push(Linhaobj);
                    console.log(LinhasLista);
                    var tr = '<tr id= row-' + row + '>' +
                        '<td id="0" style="white-space:pre-wrap;">' + document.getElementById('btnTecnologia').innerText + '</td>' +
                        '<td id="1" style="white-space:pre-wrap;">' + document.getElementById('btnOrigemObjeto').innerText + "/" +
                        "<br>" + document.getElementById('btnTipoObjeto').innerText + '</td>' +
                        '<td id="2" style="white-space:pre-wrap;">' + document.getElementById('txtDescricao').value + '</td>' +
                        '<td id="3" style="white-space:pre-wrap;">' + document.getElementById('btnNivelComplexidade').innerText + '</td>' +
                        '<td id="4" style="white-space:pre-wrap;">' + document.getElementById('txtComplexidade').value + '</td>' +

                        '<td id="5">' + total + 'h' + '</td>' +
                        '<td id="6">' + linha.analiseViabilidade + 'h' + '</td>' +
                        '<td id="7">' + linha.especificacaoTecnica + 'h' + '</td>' +
                        '<td id="8">' + linha.codificacao + 'h' + '</td>' +
                        '<td id="9">' + linha.teste + 'h' + '</td>' +
                        '</tr>';
                    $('#grid-basic').find('tbody').append(tr);

                    $("#totalSum").text(parseInt($("#totalSum").text()) + parseInt(total) + "h");
                    $("#analiseSum").text(parseInt($("#analiseSum").text()) + parseInt(linha.analiseViabilidade) + "h");
                    $("#especificacaoSum").text(parseInt($("#especificacaoSum").text()) + parseInt(linha.especificacaoTecnica) + "h");
                    $("#codificacaoSum").text(parseInt($("#codificacaoSum").text()) + parseInt(linha.codificacao) + "h");
                    $("#testesSum").text(parseInt($("#testesSum").text()) + parseInt(linha.teste) + "h");
                    limparCadastro();
                    console.log(row);


                });
            }
            else{
                $("#modalFail").find("h4").text(result.msg);
                $("#modalFail").modal("show");
            }
        });
}

function limparCadastro() {
    $("#menuObjetos").empty();

    document.getElementById('btnTecnologia').innerHTML = ("Escolha uma opção");
    document.getElementById('btnTipoObjeto').innerHTML = ("Escolha uma opção");
    document.getElementById('btnOrigemObjeto').innerHTML = ("Escolha uma opção");
    document.getElementById('btnNivelComplexidade').innerHTML = ("Escolha uma opção");
    document.getElementById('txtDescricao').value = ("");
    document.getElementById('txtComplexidade').value = ("");

    document.getElementById('btnTecnologia').value = 0;
    document.getElementById('btnTipoObjeto').value = 0;
    document.getElementById('btnOrigemObjeto').value = 0;
    document.getElementById('btnNivelComplexidade').value = 0;

    document.getElementById("btnTecnologia").style.backgroundColor = "#dadada";
    document.getElementById("btnTipoObjeto").style.backgroundColor = "#dadada";
    document.getElementById("btnOrigemObjeto").style.backgroundColor = "#dadada";
    document.getElementById("btnNivelComplexidade").style.backgroundColor = "#dadada";
}