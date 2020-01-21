//Soma NOVO
$(document).ready(function () {
    $("#nmbanalise, #nmbespecificacao, #nmbcodificacao, #nmbtestes").on('change', function () {


        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#nmbanalise').val()) || 0;
        var especificacao = parseInt($('#nmbespecificacao').val()) || 0;
        var codificacao = parseInt($('#nmbcodificacao').val()) || 0;
        var testes = parseInt($('#nmbtestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#nmbtotal').val(total);
    });
});

$(document).ready(function () {
    $("#nbanalise, #nbespecificacao, #nbcodificacao, #nbtestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#nbanalise').val()) || 0;
        var especificacao = parseInt($('#nbespecificacao').val()) || 0;
        var codificacao = parseInt($('#nbcodificacao').val()) || 0;
        var testes = parseInt($('#nbtestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#nbtotal').val(total);
    });
});

$(document).ready(function () {
    $("#nmanalise, #nmespecificacao, #nmcodificacao, #nmtestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#nmanalise').val()) || 0;
        var especificacao = parseInt($('#nmespecificacao').val()) || 0;
        var codificacao = parseInt($('#nmcodificacao').val()) || 0;
        var testes = parseInt($('#nmtestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#nmtotal').val(total);
    });
});

$(document).ready(function () {
    $("#naanalise, #naespecificacao, #nacodificacao, #natestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#naanalise').val()) || 0;
        var especificacao = parseInt($('#naespecificacao').val()) || 0;
        var codificacao = parseInt($('#nacodificacao').val()) || 0;
        var testes = parseInt($('#natestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#natotal').val(total);
    });
});

$(document).ready(function(){
    $("#nmaanalise, #nmaespecificacao, #nmacodificacao, #nmatestes").on('change', function(){

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#nmaanalise').val()) || 0;
        var especificacao = parseInt($('#nmaespecificacao').val()) || 0;
        var codificacao = parseInt($('#nmacodificacao').val()) || 0;
        var testes = parseInt($('#nmatestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#nmatotal').val(total);
    });
});

//Soma MODIFICACAO
$(document).ready(function () {
    $("#mmbanalise, #mmbespecificacao, #mmbcodificacao, #mmbtestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#mmbanalise').val()) || 0;
        var especificacao = parseInt($('#mmbespecificacao').val()) || 0;
        var codificacao = parseInt($('#mmbcodificacao').val()) || 0;
        var testes = parseInt($('#mmbtestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#mmbtotal').val(total);
    });
});

$(document).ready(function () {
    $("#mbanalise, #mbespecificacao, #mbcodificacao, #mbtestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#mbanalise').val()) || 0;
        var especificacao = parseInt($('#mbespecificacao').val()) || 0;
        var codificacao = parseInt($('#mbcodificacao').val()) || 0;
        var testes = parseInt($('#mbtestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#mbtotal').val(total);
    });
});

$(document).ready(function () {
    $("#mmanalise, #mmespecificacao, #mmcodificacao, #mmtestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#mmanalise').val()) || 0;
        var especificacao = parseInt($('#mmespecificacao').val()) || 0;
        var codificacao = parseInt($('#mmcodificacao').val()) || 0;
        var testes = parseInt($('#mmtestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#mmtotal').val(total);
    });
});

$(document).ready(function () {
    $("#maanalise, #maespecificacao, #macodificacao, #matestes").on('change', function () {

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#maanalise').val()) || 0;
        var especificacao = parseInt($('#maespecificacao').val()) || 0;
        var codificacao = parseInt($('#macodificacao').val()) || 0;
        var testes = parseInt($('#matestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#matotal').val(total);
    });
});

$(document).ready(function(){
    $("#mmaanalise, #mmaespecificacao, #mmacodificacao, #mmatestes").on('change', function(){

        $(this).val(this.value.replace(/\D/g, ''));

        var analise = parseInt($('#mmaanalise').val()) || 0;
        var especificacao = parseInt($('#mmaespecificacao').val()) || 0;
        var codificacao = parseInt($('#mmacodificacao').val()) || 0;
        var testes = parseInt($('#mmatestes').val()) || 0;

        var total = analise + especificacao + codificacao + testes;

        $('#mmatotal').val(total);
    });
});


