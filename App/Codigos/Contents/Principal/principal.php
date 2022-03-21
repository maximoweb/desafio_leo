<?php

$campos = ['CURSO_TITULO', 'CURSO_URL_AMIGAVEL', 'CURSO_IMAGEM', 'CURSO_TITULO'];
$listSlider = Crud::Read("desleo_cursos", "where CURSO_SLIDE = 'S'", $campos);

$conts["SLIDE"] = View::IncludeEach("Contents/Principal/Internas/slide", $listSlider);


//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)
$principal = View::Include("Contents/" . caminhorDir, $conts);
echo $principal;