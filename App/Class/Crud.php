<?php
require __DIR__ . '/Conexao.php';

//InOut - Metodos de Entrada e Saida de Dados Formatados (Date,Decimal,utf8)
require __DIR__ . '/InOut.php';

class Crud extends Conexao
{

    static public function Create($table, $campos = array())
    {
        $con = parent::Conn();
        #FILTER_SANITIZE_ADD_SLASHES - escapa caracteres especiais (\',\\)
        $campos = filter_var_array($campos, FILTER_SANITIZE_ADD_SLASHES);
        $campos = InOut::setDataIn($campos);
        $cps = "`" . implode("`,`", array_keys($campos)) . "`";
        $values = "'" . implode("','", $campos) . "'";
        $insert =  "insert into `$table` ($cps) values ($values) ";
        $ret["crud"] = 'create';
        try {
            if (!mysqli_query($con, $insert)) {
                throw new Exception(mysqli_error($con));
            }
            $ret['sts'] = 'ok';
            $ret["id"] = mysqli_insert_id($con);
        } catch (Exception $e) {
            $ret['sts'] = 'erro';
            $ret["erro"] = $e->getMessage();
            $ret["msg"] = $ret["erro"];
        }
        return $ret;
    }

    static public function Read($table, $where, $campos = [])
    {
        $con = parent::Conn();
        $campos = "`" . implode("`,`", $campos) . "`";
        if ($campos == '`*`') $campos = '*';
        $sel = "select $campos from $table $where";
        $qry = mysqli_query($con, $sel);
        while ($ln = mysqli_fetch_assoc($qry)) {
            $ret[] = InOut::setDataOut($ln);
        }

        return $ret ?? mysqli_error($con);
    }
}