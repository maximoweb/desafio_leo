<?php
require __DIR__ . "/App/Class/View.php";

//CRIANDO CAMINHOS / ROTAS
$router = $_GET["router"] ?? "principal"; // Se não existir, utiliza o principal
$router = explode("/", $router); // transforma em array
$router = implode("/", array_filter($router)); //LIMPANDO OS ARRAYS VAZIOS
$router = explode("/", $router); // novamente transformando em array
foreach ($router as $dirota) {
    $urlrota[] = ucfirst($dirota);
}
define("filephp", end($router));
define("caminhorDir", implode("/", array_filter($urlrota)) . "/" . filephp);
//FIM - CRIANDO CAMINHOS / ROTAS


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
    require __DIR__ . "/App/Codigos/Header/header.php";
    require __DIR__ . "/App/Codigos/Contents/" . caminhorDir . '.php';
    require __DIR__ . "/App/Codigos/Footer/footer.php";
    ?>
</body>

</html>