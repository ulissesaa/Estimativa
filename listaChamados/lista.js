function carregarTodosCabecalhos() {
    $("#tbodyLista").find('tr').remove();
    $("#tbodyObjetos").find('tr').remove();
    document.getElementById('analiseSum').innerHTML = 0;
    document.getElementById('especificacaoSum').innerHTML = 0;
    document.getElementById('codificacaoSum').innerHTML = 0;
    document.getElementById('testesSum').innerHTML = 0;
    document.getElementById('totalSum').innerHTML = 0;
    var form = new FormData();
    form.append('type', 'todos-chamados');
    $.ajax({
        type: "POST",
        url: '../php/api/GetTodosCabecalhos.php',
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $("#modalLoading").modal('show');
        },
        success: function (response) {
            $("#modalLoading").modal('hide');
            console.log(response);
            if (response.error) {
                alert(response.msg);
            } else {
                $.each(response, function (index, res) {
                    var tr = '<tr clickable name="linhaLista" data-row-id=' + res.codigo + 'aria-selected = false>' +
                        '<td class="select-cell"> <input name="select" type="checkbox" class="select-box" value=' + res.codigo + '></td>' +
                        '<td class="text-left" style="">' + res.numeroChamado + '</td>' +
                        '<td class="text-left" style="">' + res.descricao + '</td>' +
                        '<td class="text-left" style="">' + res.projeto + '</td>' +
                        '<td class="text-left" style="">' + res.dataCriacao + '</td>' +
                        '<td class="text-left" style="">' + res.responsavel + '</td>' +
                        '<td class="text-center" style="">' +
                        '<button type="button" onclick="GerarPDF(this.id)" class="border-0 bg-transparent" id="'+ res.codigo +'" data-row-id=' + res.codigo + '><img src="../img/pdf-30.png"></button></td></tr>';
                    $('#grid-lista').find('tbody').append(tr);
                });
            }
            $(":checkbox").change(function () {
                if (this.checked) {
                    $(":checkbox").attr("checked", false);
                    $(this).prop("checked", true)
                    $("#tbodyObjetos").find('tr').remove();
                    CarregarObjetos($(this).val());
                    document.getElementById('analiseSum').innerHTML = 0;
                    document.getElementById('especificacaoSum').innerHTML = 0;
                    document.getElementById('codificacaoSum').innerHTML = 0;
                    document.getElementById('testesSum').innerHTML = 0;
                    document.getElementById('totalSum').innerHTML = 0;
                } else {
                    $("#tbodyObjetos").find('tr').remove();
                    document.getElementById('analiseSum').innerHTML = 0;
                    document.getElementById('especificacaoSum').innerHTML = 0;
                    document.getElementById('codificacaoSum').innerHTML = 0;
                    document.getElementById('testesSum').innerHTML = 0;
                    document.getElementById('totalSum').innerHTML = 0;
                }

            });
        }

    });
}

function PesquisaCabecalho() {
    $("#tbodyLista").find('tr').remove();
    $("#tbodyObjetos").find('tr').remove();
    document.getElementById('analiseSum').innerHTML = 0;
    document.getElementById('especificacaoSum').innerHTML = 0;
    document.getElementById('codificacaoSum').innerHTML = 0;
    document.getElementById('testesSum').innerHTML = 0;
    document.getElementById('totalSum').innerHTML = 0;
    var formPOST = definirType();

    $.ajax({
        type: "POST",
        url: '../php/api/GetTodosCabecalhos.php',
        data: formPOST,
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function () {
            $("#modalLoading").modal('show');
        },
        success: function (response) {
            $("#modalLoading").modal('hide');
            console.log(response);
            if (response.error) {
                console.log(response.msg);
            } else { 
                $.each(response, function (index, res) {
                    var tr = '<tr name="linhaLista" id="' + res.codigo + '" data-row-id=' + res.codigo + 'aria-selected = false>' +
                        '<td class="select-cell"> <input name="select" type="checkbox" class="select-box" value=' + res.codigo + '></td>' +
                        '<td class="text-left" style="">' + res.numeroChamado + '</td>' +
                        '<td class="text-left" style="white-space:pre-wrap;">' + res.descricao + '</td>' +
                        '<td class="text-left" style="white-space:pre-wrap;">' + res.projeto + '</td>' +
                        '<td class="text-center" style="">' + res.dataCriacao + '</td>' +
                        '<td class="text-left" style="white-space:pre-wrap;">' + res.responsavel + '</td>' +
                        '<td class="text-left" style="">' +
                        '<button type="button" onclick="GerarPDF(this.id)" class="border-0 bg-transparent" id="'+ res.codigo +'" data-row-id=' + res.codigo + '><img src="../img/pdf-30.png"></button></td></tr>';
                    $('#grid-lista').find('tbody').append(tr);
                });
            }
            $(":checkbox").change(function () {
                if (this.checked) {
                    $(":checkbox").attr("checked", false);
                    $(this).prop("checked", true);
                    $("#tbodyObjetos").find('tr').remove();
                    CarregarObjetos($(this).val());
                    document.getElementById('analiseSum').innerHTML = 0;
                    document.getElementById('especificacaoSum').innerHTML = 0;
                    document.getElementById('codificacaoSum').innerHTML = 0;
                    document.getElementById('testesSum').innerHTML = 0;
                    document.getElementById('totalSum').innerHTML = 0;
                } else {
                    $("#tbodyObjetos").find('tr').remove();
                    document.getElementById('analiseSum').innerHTML = 0;
                    document.getElementById('especificacaoSum').innerHTML = 0;
                    document.getElementById('codificacaoSum').innerHTML = 0;
                    document.getElementById('testesSum').innerHTML = 0;
                    document.getElementById('totalSum').innerHTML = 0;
                }
            });
        }
    });
}

function GerarPDF(id){
    window.open('../pdf/GerarPDF.php?cod='+id);
}

function CarregarObjetos(codigo) {
    $.ajax({
        type: 'POST',
        url: '../php/api/GetObjetosChamado.php',
        data: {
            cod: codigo
        },
        cache: false,
        dataType: 'json',
        beforeSend: function () {
            $("#modalLoading").modal("show");
        },
        success: function (response) {
            $("#modalLoading").modal("hide");
            if (response.error) {
                console.log(response.msg);
            } else {
                $.each(response, function (index, linha) {
                    var total = parseInt(linha.analiseViabilidade) + parseInt(linha.especificacaoTecnica) + parseInt(linha.codificacao) + parseInt(linha.teste);
                    var tr = '<tr>' +
                        '<td class="text-left" style="">' + linha.Tecnologia + '</td>' +
                        '<td class="text-left" style="">' + linha.Origem + '</td>' +
                        '<td class="text-left" style="">' + linha.Objeto + '</td>' +
                        '<td class="text-left" style="">' + linha.Complexidade + '</td>' +
                        '<td class="text-center"><span style="font-weight: bold">' + total + '</span></td>' +
                        '<td class="text-center" style="">' + linha.analiseViabilidade + '</td>' +
                        '<td class="text-center" style="">' + linha.especificacaoTecnica + '</td>' +
                        '<td class="text-center" style="">' + linha.codificacao + '</td>' +
                        '<td class="text-center" style="">' + linha.teste + '</td></tr>' ;
                    $('#grid-objetos').find('tbody').append(tr);
                    //////////////////////////////////////////////////////////////////////////////
                    $("#totalSum").text(parseInt($("#totalSum").text()) + parseInt(total) + "h");
                    $("#analiseSum").text(parseInt($("#analiseSum").text()) + parseInt(linha.analiseViabilidade) + "h");
                    $("#especificacaoSum").text(parseInt($("#especificacaoSum").text()) + parseInt(linha.especificacaoTecnica) + "h");
                    $("#codificacaoSum").text(parseInt($("#codificacaoSum").text()) + parseInt(linha.codificacao) + "h");
                    $("#testesSum").text(parseInt($("#testesSum").text()) + parseInt(linha.teste) + "h");

                });
            }
        },
        error(a) {
            $("#modalLoading").modal("hide");
            console.log(a);
        }

    });
}

function LimparTabela() {
    $("#tbodyLista").find('tr').remove();
    $("#tbodyObjetos").find('tr').remove();

    document.getElementById('chamado').value = ("");
    document.getElementById('responsavel').value = ("");
    document.getElementById('dataInicio').value = ("");
    document.getElementById('dataFim').value = ("");
    document.getElementById('analiseSum').innerHTML = 0;
    document.getElementById('especificacaoSum').innerHTML = 0;
    document.getElementById('codificacaoSum').innerHTML = 0;
    document.getElementById('testesSum').innerHTML = 0;
    document.getElementById('totalSum').innerHTML = 0;
    
}

function definirType() {

    var form = new FormData();
    var chamado = $("#chamado").val();
    var responsavel = $("#responsavel").val();
    var dataInicio = $("#dataInicio").val();
    var dataFim = $("#dataFim").val();

    if (chamado.trim().length != 0 && responsavel.trim().length == 0 && dataInicio.trim().length == 0 && dataFim.trim().length == 0) {

        form.append('type', 'por-chamado');
        form.append('chamado', chamado);
        return form;
    } else if (chamado.trim().length == 0 && responsavel.trim().length != 0 && dataInicio.trim().length == 0 && dataFim.trim().length == 0) {

        form.append('type', 'por-responsavel');
        form.append('responsavel', responsavel);
        return form;
    } else if (chamado.trim().length == 0 && responsavel.trim().length == 0 && dataInicio.trim().length != 0 && dataFim.trim().length != 0) {

        form.append('type', 'dataRange');
        form.append('dataInicio', dataInicio);
        form.append('dataFim', dataFim);
        return form;
    } else if (chamado.trim().length != 0 && responsavel.trim().length == 0 && dataInicio.trim().length != 0 && dataFim.trim().length != 0) {
        form.append('type', 'chamado-data');
        form.append('chamado', chamado);
        form.append('dataInicio', dataInicio);
        form.append('dataFim', dataFim);
        return form;
    } else if (chamado.trim().length == 0 && responsavel.trim().length != 0 && dataInicio.trim().length != 0 && dataFim.trim().length != 0) {
        form.append('type', 'responsavel-data');
        form.append('responsavel', responsavel);
        form.append('dataInicio', dataInicio);
        form.append('dataFim', dataFim);
        return form;
    } else if (chamado.trim().length != 0 && responsavel.trim().length != 0 && dataInicio.trim().length != 0 && dataFim.trim().length != 0) {
        form.append('type', 'todos-parametros');
        form.append('chamado', chamado);
        form.append('responsavel', responsavel);
        form.append('dataInicio', dataInicio);
        form.append('dataFim', dataFim);
        return form;
    } else if (chamado.trim().length != 0 && responsavel.trim().length != 0 && dataInicio.trim().length == 0 && dataFim.trim().length == 0) {
        form.append('type', 'chamado-responsavel');
        form.append('responsavel', responsavel);
        form.append('chamado', chamado);
        return form;
    } else {
        alert('Campos obrigatórios não preenchidos!');
    }

}