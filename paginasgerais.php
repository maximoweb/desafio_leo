<?php
//esse arquivo � acionado quando a URL em seu primeiro par�metro inicia com "pgs" ex: www.bbb.com.br/pgs/(pagina)
//pagina e relacionado � pagina dentro do App/Codigos/Contents/Geral/(pagina.php)
//que por sua vez busca o template no caminho App/Views/Contents/Geral/(pagina.html)
$pg =  $_GET["router"];
require __DIR__ . "/App/Class/View.php";
require __DIR__ . "/App/Codigos/Geral/$pg.php";