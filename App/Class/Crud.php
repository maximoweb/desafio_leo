<?php
require __DIR__ . '/Conexao.php';

//Metodos de Entrada e Saida de Dados (Date,Decimal,utf8)
require __DIR__ . '/InOut.php';

class Crud extends Conexao
{
    static public function Read($table, $where, $campos = array())
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