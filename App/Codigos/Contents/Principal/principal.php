<?php

$listSlider = Crud::Read("desleo_cursos", "where CURSO_SLIDE = 'S'", ["*"]);
print_r($listSlider);



$conts = [
    "titulo" => "Desafio Leo",
    "nome" => "Luan"
];


//View::Include("Contents/Principal/principal", $conts);
//caminhorDir - Pegando caminho do index
// Mas pode ser colocado Manual
View::Include("Contents/" . caminhorDir, $conts);