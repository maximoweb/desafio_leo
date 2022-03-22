$(document).ready(function () {
    console.log("Carregou Main.js - Desafio LEO");

    var urlcod = "App/Ajax/gerenciar-cursos.php";

    $("body").on("click", "#Modal span.btnFechar", function () {
        $("body").removeClass("overlay Modal");
    })

    if (typeof (modalini) !== 'undefined') {
        $("#Modal .contentsModal").load("modalunico.php");
        $("body").addClass("Modal overlay");
    }


    $("body").on("click", "#btnPesquisa", function () {
        var termo = $("#cp_busca").val();
        window.location = "busca/" + encodeURI(termo);
    })



    //Ação Botão Cadastrar/Atualizar Curso
    $("body").on("click", "#atualizarCurso", function () {
        $("body").addClass("overlay");
        $("#loading").addClass("active");
        var myForm = document.querySelector('form#formCurso');
        var formData = new FormData(myForm);
        $.ajax({
            url: urlcod,
            type: 'POST',
            data: formData,
            success: function (res) {
                console.log(res);
                $("body").removeClass("overlay");
                $("#loading").removeClass("active");
                var ret = JSON.parse(res);
                if (ret.sts == "ok") {
                    alert(ret.msg);
                    window.location = '';
                    $("#CURSO_ID").val(ret.id);
                }
                alert(ret.msg);
                console.log(ret);
            },
            contentType: false,
            processData: false
        });
    });


    $("body").on("click", "#removerCurso", function () {
        if (confirm("Deseja Excluir esse Curso?")) {
            $("body").addClass("overlay");
            $("#loading").addClass("active");
            var dados = "CURSO_ID=" + $('form#formCurso #CURSO_ID').val();
            $.get(urlcod, "ACAO=delete&" + dados, function (res) {
                console.log(res);
                var ret = JSON.parse(res);
                if (ret.sts == "ok") {
                    window.location = '';
                    return false;
                } else {
                    alert(ret.msg);
                }
                $("body").removeClass("overlay");
                $("#loading").removeClass("active");
            })
        }

    });

    //Carrega dados no Formulario
    var CURSO_ID = $("#CURSO_ID").val();
    if (CURSO_ID > 0) {
        $("body").addClass("overlay");
        $("#loading").addClass("active");
        $.get(urlcod, "ACAO=listar&CURSO_ID=" + CURSO_ID, function (res) {
            console.log(res);
            var ret = JSON.parse(res);
            if (ret.CURSO_ID == 0) {
                window.location = '';
                return false;
            }
            console.log(ret);
            $.each(ret, function (ch, val) {
                $("#" + ch).val(val);
            })
            $("body").removeClass("overlay");
            $("#loading").removeClass("active");
        })
    }



    //Bloco Codigo SlideShow
    var qdSlide = $("#banner > div.slide").length;
    $("#banner > div.slide").each(function () {
        $(this).css("z-index", qdSlide);
        qdSlide--;
    })

    function trocaSlide() {
        var qdTotal = $("#banner > div.slide").length;
        var slide = 1;
        $("#banner > div.slide:nth-child(" + slide + ")").addClass('active');
        setInterval(function () {
            console.log(slide);
            $("#banner > div.slide").removeClass('active');
            if (slide < qdTotal) {
                $("#banner > div.slide:nth-child(" + slide + ")").fadeOut(1000);
                $("#banner > div.slide:nth-child(" + (slide + 1) + ")").addClass('active');
            } else {
                $("#banner > div.slide").fadeIn(1000);
                $("#banner > div.slide:nth-child(1)").addClass('active');
                slide = 0;
            }
            slide++;
        }, 5000)
    }
    trocaSlide();


})