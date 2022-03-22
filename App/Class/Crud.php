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

    public static function Update($table, $where, $campos = array())
    {
        $con = parent::Conn();
        #FILTER_SANITIZE_ADD_SLASHES - escapa caracteres especiais (\',\\)
        $campos = filter_var_array($campos, FILTER_SANITIZE_ADD_SLASHES);
        $campos = InOut::setDataIn($campos); //ajusta os dados para entrada no banco de dados
        $ret["crud"] = 'update';
        foreach ($campos as $key => $value) {
            $cps[] = "`$key` = '$value'";
        }
        $camposset = implode(", ", $cps);
        $ret['sts'] = 'ok';
        $update = "update `$table` set $camposset $where ";
        if (!mysqli_query($con, $update)) {
            $ret['sts'] = 'erro';
            $ret["erro"] = mysqli_error($con);
        }
        $ret["affected_rows"] = mysqli_affected_rows($con);
        return $ret;
    }

    public static function Delete($table, $where)
    {
        $con = parent::Conn();
        $del = "delete from `$table` $where";
        $ret['sts'] = 'ok';
        if (!mysqli_query($con, $del)) {
            $ret['sts'] = 'erro';
            $ret["erro"] = mysqli_error($con);
        }
        $ret["affected_rows"] = mysqli_affected_rows($con);
        return $ret;
    }
}