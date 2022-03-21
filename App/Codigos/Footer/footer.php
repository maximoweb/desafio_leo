<?php
#Classe View com metodo Include para utilizar Template
$footer = View::Include(
    "Footer/footer",
    [
        "titulo" => "Desafio Leo",
        "nome" => "Luan"
    ]
);
echo $footer;