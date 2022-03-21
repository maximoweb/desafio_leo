<?php
//CRIANDO CAMINHOS / ROTAS
$router = $_GET["router"] ?? "principal"; // Se não existir, utiliza o principal
$router = explode("/", $router); // transforma em array
$router = implode("/", array_filter($router)); //LIMPANDO OS ARRAYS VAZIOS
$router = explode("/", $router); // novamente transformando em array
foreach ($router as $dirota) {
    $urlrota[] = ucfirst($dirota);
}
define("fileroute", end($router));
define("caminhorDir", implode("/", array_filter($urlrota)) . "/" . fileroute);
//FIM - CRIANDO CAMINHOS / ROTAS