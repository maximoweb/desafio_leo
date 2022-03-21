<?php

class Conexao
{
    private static $instance;

    public static function Conn()
    {
        require __DIR__ . '/../Config/Conexao.php';
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect($cfgbd["servidor"], $cfgbd["usuario"], $cfgbd["senha"], $cfgbd["banco"]);
        }
        return self::$instance;
    }
}