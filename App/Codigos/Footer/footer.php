<?php
#Classe View com metodo Include para utilizar Template


$footer = View::Include(
    "Footer/footer",
    [
        "modal" => "Desafio Leo"
    ]
);
echo $footer;