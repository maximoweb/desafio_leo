<?php
header("Content-Type: text/css");
require __DIR__ . "/plugins/scssphp/scss.inc.php";


//Configurar os Caminhos do SCSS
$assetscss = __DIR__ . "/assets/css/*css";
$glob = glob($assetscss);

$dirScss[] = "/asset/View/Header/header.scss";
$dirScss[] = "/App/View/Header/header.scss";
$dirScss[] = "/App/View/Contents/Principal/principal.scss";
$dirScss[] = "/App/View/Footer/footer.scss";


use ScssPhp\ScssPhp\Compiler;

$compiler = new Compiler();

$dadoscss[] = '/*INICIO DO MICROPROCESSAMENTO CSS*/ ';

//FOREACH NOS ARQUIVOS GERAIS DENTRO DO DIRETORIO ASSES/CSS
foreach ($glob as $arqcss) {
    $dadoscss[] = "/*Trecho referente ao arquivo " . basename($arqcss) . " */ ";
    $dadoscss[] = file_get_contents($arqcss);
}

//FOREACH NOS ARQUIVOS DE ARRAY COM CAMINHO MANUAL
foreach ($dirScss as $arqcss) {
    $arquivocss = __DIR__ .  $arqcss;
    if (is_file($arquivocss)) {
        $dadoscss[] = "/*Trecho referente ao arquivo " . basename($arquivocss) . " */ ";
        $dadoscss[] = file_get_contents($arquivocss);
    }
}

$dados = implode("\r\n", $dadoscss);
echo $compiler->compileString($dados)->getCss();