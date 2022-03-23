<?php

#Classe View com metodo Include para utilizar Template
$modal = View::Include(
    "Geral/modal",
    [
        "modal" => "conteudo dinamico"
    ]
);
echo $modal;