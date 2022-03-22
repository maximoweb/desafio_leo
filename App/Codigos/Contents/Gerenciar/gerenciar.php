<?php
$ID = $_GET["curso"] ?? 0;
$nomeacao = $ID == 0 ? 'Adicionar' : 'Atualizar';
$btnExcluir = $ID > 0 ? '<button id="removerCurso">Excluir</button>' : '';
//caminhorDir - Pegando caminho do Config/Router
// Mas pode ser colocado Manual (igual Acima)
$CPS = [
    "nomeacao" => $nomeacao,
    "SESID" => session_id(),
    "CURSOID" => $ID,
    "BTNEXCLUIR" => $btnExcluir
];
echo View::Include("Contents/" . caminhorDir, $CPS);