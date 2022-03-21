<?php
require __DIR__ . '/Crud.php';
class View extends Crud
{
    public static function Include($pagina, $substituir = [])
    {
        $pg = file_get_contents(__DIR__ . "/../View/" . $pagina . ".html");
        return self::Replace($pg, $substituir);
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

    //Substituindo dados do View em loop
    public static function IncludeEach($dirpagina, $array = [])
    {
        if (count($array) > 0) {
            foreach ($array as $ar) {
                $inSlide[] = View::Include($dirpagina, $ar);
            }
            return implode("", $inSlide);
        }
    }
}