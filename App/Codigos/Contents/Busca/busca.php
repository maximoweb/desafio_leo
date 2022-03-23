<?php
$termopesquisa = $_GET["termo"];

$campos = ['CURSO_TITULO', 'CURSO_URL_AMIGAVEL', 'CURSO_IMAGEM', 'CURSO_DESCRICAO', 'CURSO_ID'];
$subst = ['CURSO_DESCRICAO' => 120]; //Retorno a descrição com até 120 Caracteres
$finalquery = "where CURSO_STATUS = 'A' and CURSO_USU_ID = " . $_SESSION["USU_ID"] . " and CURSO_TITULO like '%$termopesquisa%' order by CURSO_TITULO";
$listCards = Crud::Read("desleo_cursos", $finalquery, $campos, $subst);

$conts["CARD"] = View::IncludeEach("Contents/Principal/Internas/card", $listCards);

$conts["termopesquisa"] = $termopesquisa;

//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)
$principal = View::Include("Contents/" . caminhorDir, $conts);
echo $principal;