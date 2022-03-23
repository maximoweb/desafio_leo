<?php
//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)


$CURSO_URL_AMIGAVEL =  $router[1];

$CURSO = Crud::Read("desleo_cursos", "where CURSO_URL_AMIGAVEL = '$CURSO_URL_AMIGAVEL'", ['*']);
echo View::Include("Contents/" . caminhorDir, $CURSO[0]);