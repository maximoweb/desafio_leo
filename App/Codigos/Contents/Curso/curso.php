<?php
//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)
$CPS = [
    'banner' => 'xxx'
];
echo View::Include("Contents/" . caminhorDir, $CPS);