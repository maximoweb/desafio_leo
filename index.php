<?php
require __DIR__ . "/App/Class/View.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio LEO</title>
</head>

<body>
    <?php
    #Classe View com metodo Include para utilizar Template
    View::Include(
        "Header/header.html",
        [
            "titulo" => "Desafio Leo"
        ]
    );
    ?>
</body>

</html>