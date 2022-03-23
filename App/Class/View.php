<?php
require __DIR__ . '/Crud.php';
class View extends Crud
{
    public static function Include($pagina, $substituir = [])
    {
        $pg = __DIR__ . "/../View/" . $pagina . ".html";
        $pg = file_get_contents($pg);
        return self::Replace($pg, $substituir);
    }

    public static function Replace($contents, $array = [])
    {
        if (count($array) > 0) {
            foreach ($array as $key => $val) {
                $keys[] = '{{' . $key . '}}';
            }
            return str_replace($keys, $array, $contents);
        } else {
            return $contents;
        }
    }

    //Substituindo dados do View em loop
    public static function IncludeEach($dirpagina, $array = [])
    {
        if (!empty($array)) {
            foreach ($array as $ar) {
                $inSlide[] = View::Include($dirpagina, $ar);
            }
            return implode("", $inSlide);
        }
    }
}