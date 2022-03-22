<?php
session_start();
if (empty($_SESSION["USU_ID"])) {
    echo "Sem Permiss�o para visualizar essa Pagina";
    exit;
}

$USU_ID = $_SESSION["USU_ID"];


require __DIR__ . '/../Class/Crud.php';


#Verificar se o Metodo de requisi��o � POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $arquivo = $_FILES["CURSO_IMG"];
        //Valida se o Arquivo est� Vazio ou que n�o tenha uma extens�o de Imagem
        if ($arquivo["size"] > 0 && ($arquivo["type"] == "image/jpeg" || $arquivo["type"] == "image/jpg" || $arquivo["type"] == "image/png")) {
            $ext = explode(".", $arquivo["name"]);
            $ext = end($ext);
            $form["CURSO_IMAGEM"] = md5(microtime()) . "." . $ext;
            if (!move_uploaded_file($arquivo["tmp_name"], '../assets/images/cursos/' . $form["CURSO_IMAGEM"])) throw new Exception("Erro ao Enviar Imagem");
        }

        //Geralmente utilizao essa compara��o caso o usuario esteja com a aba do form aberta com um usu�rio e abre outra com outro usu�rio/sessao
        if (empty($USU_ID) || session_id() != $form["CURSO_SESSION_ID"]) throw new Exception("Inconsistencia na Session");

        $ID = $form["CURSO_ID"]; //atribuindo � variavel ID = Id do campo
        unset($form["CURSO_ID"]); //Removendo o campo ID para n�o entrar como campo na Tabela
        $form["CURSO_USU_ID"] = $USU_ID;
        if (is_numeric($ID)) {
            if ($ID == 0) //inserir
            {
                $create = Crud::Create("desleo_cursos", $form);
                if ($create["sts"] == "erro") throw new Exception($create["msg"]);
                $ret["msg"] = "Curso Inserido com sucesso!";
                $ret["id"] = $create["id"];
            } else { //update
                foreach ($form as $ch => $val) {
                    $camposSet[] = "`$ch` = '$val'";
                }
                $camposSet = implode(", ", $camposSet);
                $atualizar = "update `desleo_cursos` set $camposSet where `$CAMPOID` = $ID ";
                //$ret["query"] = $atualizar;
                if (!mysqli_query($conn, $atualizar)) throw new Exception(mysqli_error($conn));
                $ret["msg"] = "Curso Atualizado com sucesso!";
                $ret["id"] = $ID;
            }
        }
        $ret["sts"] = "ok";
    } catch (Exception $e) {
        $ret["sts"] = "erro";
        $ret["msg"] = $e->getMessage();
    }
    echo json_encode(InOut::utf8E($ret));
}


#Verificar se o Metodo de requisi��o � GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $form = $_GET;
    if ($form["ACAO"] == "listar") {
        $listCurso = Crud::Read("desleo_cursos", "where CURSO_ID = '" . $form["CURSO_ID"] . "' and CURSO_USU_ID = '" . $USU_ID . "'", ['*']);
        echo json_encode(InOut::utf8E($listCurso[0])); //Metodo utf8E utilizado para n�o ter problemas de caracter especial na codifica��o Json
    }
}