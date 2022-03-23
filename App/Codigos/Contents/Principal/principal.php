<?php

$campos = ['CURSO_TITULO', 'CURSO_URL_AMIGAVEL', 'CURSO_IMAGEM'];
$listSlider = Crud::Read("desleo_cursos", "where CURSO_SLIDE = 'S'", $campos);
$conts["SLIDE"] = View::IncludeEach("Contents/Principal/Internas/slide", $listSlider);

$campos = ['CURSO_TITULO', 'CURSO_URL_AMIGAVEL', 'CURSO_IMAGEM', 'CURSO_DESCRICAO', 'CURSO_ID'];
$subst = ['CURSO_DESCRICAO' => 120]; //Retorno a descrição com até 120 Caracteres
$finalquery = "where CURSO_USU_ID = " . $_SESSION["USU_ID"] . " order by CURSO_TITULO";
$listCards = Crud::Read("desleo_cursos", $finalquery, $campos, $subst);
$conts["CARD"] = View::IncludeEach("Contents/Principal/Internas/card", $listCards);

//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)
$principal = View::Include("Contents/" . caminhorDir, $conts);
echo $principal;