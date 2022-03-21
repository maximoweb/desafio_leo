<?php

$conts = [
    "titulo" => "Desafio Leo",
    "nome" => "Luan"
];


//View::Include("Contents/Principal/principal", $conts);
View::Include("Contents/" . caminhorDir, $conts); //caminhorDir - Pegando caminho do index