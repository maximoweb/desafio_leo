<?php
session_start();
if (empty($_SESSION["USU_ID"])) {
    echo "Sem Permissão para visualizar essa Pagina";
    exit;
}

$USU_ID = $_SESSION["USU_ID"];


require __DIR__ . '/../Class/Crud.php';


#Verificar se o Metodo de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $arquivo = $_FILES["CURSO_IMG"];
        //Valida se o Arquivo está Vazio ou que não tenha uma extensão de Imagem
        if ($arquivo["size"] > 0 && ($arquivo["type"] == "image/jpeg" || $arquivo["type"] == "image/jpg" || $arquivo["type"] == "image/png")) {
            $ext = explode(".", $arquivo["name"]);
            $ext = end($ext);
            $form["CURSO_IMAGEM"] = md5(microtime()) . "." . $ext;
            if (!move_uploaded_file($arquivo["tmp_name"], '../assets/images/cursos/' . $form["CURSO_IMAGEM"])) throw new Exception("Erro ao Enviar Imagem");
        }

        //Geralmente utilizao essa comparação caso o usuario esteja com a aba do form aberta com um usuário e abre outra com outro usuário/sessao
        if (empty($USU_ID) || session_id() != $form["CURSO_SESSION_ID"]) throw new Exception("Inconsistencia na Session");

        $ID = $form[$CAMPOID]; //atribuindo à variavel ID = Id do campo
        unset($form[$CAMPOID]); //Removendo o campo ID para não entrar como campo na Tabela
        $form["CURSO_USU_ID"] = $USU_ID;
        if (is_numeric($ID)) {
            if ($ID == 0) //inserir
            {
            } else { //update

            }
        }
        $ret["sts"] = "ok";
    } catch (Exception $e) {
        $ret["sts"] = "erro";
        $ret["msg"] = $e->getMessage();
    }
    echo json_encode(InOut::utf8E($ret));
}


#Verificar se o Metodo de requisição é GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $form = $_GET;
    if ($form["ACAO"] == "listar") {
        $listCurso = Crud::Read("desleo_cursos", "where CURSO_ID = '" . $form["CURSO_ID"] . "' and CURSO_USU_ID = '" . $USU_ID . "'", ['*']);
        echo json_encode(InOut::utf8E($listCurso[0])); //Metodo utf8E utilizado para não ter problemas de caracter especial na codificação Json
    }
}