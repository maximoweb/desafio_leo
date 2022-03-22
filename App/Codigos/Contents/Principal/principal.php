<?php

$campos = ['CURSO_TITULO', 'CURSO_URL_AMIGAVEL', 'CURSO_IMAGEM'];
$listSlider = Crud::Read("desleo_cursos", "where CURSO_SLIDE = 'S'", $campos);
$conts["SLIDE"] = View::IncludeEach("Contents/Principal/Internas/slide", $listSlider);

$campos = ['CURSO_TITULO', 'CURSO_URL_AMIGAVEL', 'CURSO_IMAGEM', 'CURSO_DESCRICAO', 'CURSO_ID'];
$listCards = Crud::Read("desleo_cursos", "where CURSO_USU_ID = " . $_SESSION["USU_ID"] . " order by CURSO_TITULO", $campos);
$conts["CARD"] = View::IncludeEach("Contents/Principal/Internas/card", $listCards);

//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)
$principal = View::Include("Contents/" . caminhorDir, $conts);
echo $principal;