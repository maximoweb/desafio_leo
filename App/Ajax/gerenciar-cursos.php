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
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $form = InOut::utf8D($form);
    $form = InOut::htmlE($form);
    try {
        $arquivo = $_FILES["CURSO_IMG"];
        //Valida se o Arquivo está Vazio ou que não tenha uma extensão de Imagem
        if ($arquivo["size"] > 0 && ($arquivo["type"] == "image/jpeg" || $arquivo["type"] == "image/jpg" || $arquivo["type"] == "image/png")) {
            $ext = explode(".", $arquivo["name"]);
            $ext = end($ext);
            $form["CURSO_IMAGEM"] = md5(microtime()) . "." . $ext;
            if (!move_uploaded_file($arquivo["tmp_name"], __DIR__ . '/../../assets/images/cursos/' . $form["CURSO_IMAGEM"])) throw new Exception("Erro ao Enviar Imagem");
        }

        $ID = $form["CURSO_ID"]; //atribuindo à variavel ID = Id do campo
        unset($form["CURSO_ID"]); //Removendo o campo ID para não entrar como campo na Tabela
        $form["CURSO_USU_ID"] = $USU_ID;
        if (is_numeric($ID)) {
            if ($ID == 0) //inserir
            {
                $create = Crud::Create("desleo_cursos", $form);
                if ($create["sts"] == "erro") throw new Exception($create["msg"]);
                $ret["msg"] = "Curso Inserido com sucesso!";
                $ret["id"] = $create["id"];
            } else { //update
                $update = Crud::Update("desleo_cursos", "where CURSO_ID = $ID", $form);
                if ($update["sts"] == "erro") throw new Exception($update["erro"]);
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


#Verificar se o Metodo de requisição é GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $form = $_GET;
    if ($form["ACAO"] == "listar") {
        $listCurso = Crud::Read("desleo_cursos", "where CURSO_ID = '" . $form["CURSO_ID"] . "' and CURSO_USU_ID = '" . $USU_ID . "'", ['*']);
        $listCurso = InOut::htmlD($listCurso[0]);
        echo json_encode(InOut::utf8E($listCurso)); //Metodo utf8E utilizado para não ter problemas de caracter especial na codificação Json
    }

    if ($form["ACAO"] == "delete") {
        $delete = Crud::Delete("desleo_cursos", "where CURSO_ID = " . $form["CURSO_ID"]);
        echo json_encode($delete);
    }
}