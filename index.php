<?php
session_start();
$_SESSION["USU_ID"] = 1; //SIMULANDO QUE J? ESTEJA CONECTADO
require __DIR__ . '/App/Config/Router.php';
require __DIR__ . '/App/Config/Cfg.php';
require __DIR__ . "/App/Class/View.php";



//Arrays dos diretorios a incluir / Utilizado para PHPs, CSS, JS, Metatags
$dirIncludes[] = "/App/Codigos/Header/header";
$dirIncludes[] = "/App/Codigos/Contents/" . caminhorDir;
$dirIncludes[] = "/App/Codigos/Footer/footer";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="<?= basesite ?>" />
    <script type="text/javascript" src="assets/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">

    <link href="scss/style.css" rel="stylesheet" type="text/css">


    <title>Desafio LEO</title>
</head>

<body>
    <?php
    //MODAL INICIAL
    echo "<script>var modalini = false</script>";
    if (empty($_SESSION["MODALINI"])) echo "<script>var modalini = true</script>";
    $_SESSION["MODALINI"] = true;
    //unset($_SESSION["MODALINI"]);

    #loop das paginas as Incluir -- Array  "$dirIncludes" no inicio desse Codigo
    foreach ($dirIncludes as $direinc) require __DIR__ . $direinc . '.php';
    ?>
</body>

</html>