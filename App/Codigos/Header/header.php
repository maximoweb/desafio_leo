<?php
#Classe View com metodo Include para utilizar Template
View::Include(
    "Header/header",
    [
        "titulo" => "Desafio Leo",
        "nome" => "Luan"
    ]
);