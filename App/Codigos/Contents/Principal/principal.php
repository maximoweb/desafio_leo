<?php

$conts = [
    "titulo" => "Desafio Leo",
    "nome" => "Luan"
];


//View::Include("Contents/Principal/principal", $conts);
//caminhorDir - Pegando caminho do index
// Mas pode ser colocado Manual
View::Include("Contents/" . caminhorDir, $conts);