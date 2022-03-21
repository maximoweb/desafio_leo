<?php
#Classe View com metodo Include para utilizar Template
$header = View::Include(
    "Header/header",
    [
        "titulo" => "Desafio Leo",
        "nome" => "Luan",
        "usuario" => "J&uacute;lio C&eacute;sar"
    ]
);
echo $header;