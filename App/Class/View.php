<?php
require __DIR__ . '/Crud.php';
class View extends Crud
{
    public static function Include($pagina, $substituir = [])
    {
        $pg = file_get_contents(__DIR__ . "/../View/" . $pagina . ".html");
        echo self::Replace($pg, $substituir);
    }

    public static function Replace($contents, $array = [])
    {

        if (count($array) > 0) {
            foreach ($array as $key => $val) {
                $keys[] = '{{' . $key . '}}';
            }
            return str_replace($keys, $array, $contents);
        }
    }
}