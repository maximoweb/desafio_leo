<?php


class InOut
{


    public static function utf8D($str)
    {
        if (is_array($str)) {
            foreach ($str as $ch => $val) {
                $str[$ch] = self::utf8D($val);
            }
            return $str;
        } else {
            return utf8_decode($str);
        }
    }

    public static function utf8E($str)
    {
        if (is_array($str)) {
            foreach ($str as $ch => $val) {
                $str[$ch] = self::utf8E($val);
            }
            return $str;
        } else {
            return utf8_encode($str);
        }
    }

    public static function DecimalOut($val, $casas = 2)
    {
        return number_format($val, $casas, ",", ".");
    }

    public static function setMask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public static function setMaskCpf($cpf)
    {
        return self::setMask($cpf, '###.###.###-##');
    }

    public static function setMaskCnpj($cpf)
    {
        return self::setMask($cpf, '##.###.###/####-##');
    }


    public static function setOnlyNumber($input)
    {
        $output = preg_replace("/[^0-9]/", "", $input);
        return $output;
    }

    public static function setDateIn($date)
    {
        if (!empty($date)) {
            $date = explode("/", $date);
            $date = $date[2] . "-" . $date[1] . "-" . $date[0];
        }
        return $date;
    }

    public static function setDateOut($date)
    {
        if ($date != "0000-00-00" and $date != "0000-00-00 00:00:00") {
            $sehora = explode(" ", $date);
            if (isset($sehora[1])) {
                return date("d/m/Y H:i", strtotime($date));
            } else {
                return date("d/m/Y", strtotime($date));
            }
        }
    }


    public static  function validar_cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }


    public static function setDataIn($array)
    {
        if (is_array($array)) {
            foreach ($array as $ch => $val) {
                if (is_array($val)) {
                    $ret[$ch] = self::setDataIn($val);
                } else {
                    $ret[$ch] = $val;
                    if (strpos($ch, "_CPF") || strpos($ch, "_CNPJ") || strpos($ch, "_CEP") || strpos($ch, "_TEL") || strpos($ch, "_CELULAR")) {
                        $ret[$ch] = self::setOnlyNumber($val);
                    }
                    if (strpos($ch, "_DATA")) {
                        $ret[$ch] = self::setDateIn($val);
                    }
                }
            }
        }
        return $ret;
    }

    public static function setDataOut($array)
    {
        foreach ($array as $ch => $val) {
            if (is_array($val)) {
                $ret[$ch] = self::setDataOut($val);
            } else {
                $ret[$ch] = $val;
                if (!empty($val)) {
                    if (strpos($ch, "_CPF")) {
                        $ret[$ch] = self::setMask($val, '###.###.###-##');
                    }
                    if (strpos($ch, "_CNPJ")) {
                        $ret[$ch] = self::setMask($val, '##.###.###/####-##');
                    }
                    if (strpos($ch, "_DATA")) {
                        $ret[$ch] = self::setDateOut($val);
                    }
                    if (strpos($ch, "_CEP")) {
                        $ret[$ch] = self::setMask($val, '#####-###');
                    }
                    if (strpos($ch, "_TEL") || strpos($ch, "_CELULAR")) {
                        if (strlen($val) == 11) {
                            $ret[$ch] = self::setMask($val, '(##)# ####-####');
                        } else {
                            $ret[$ch] = self::setMask($val, '(##)####-####');
                        }
                    }
                }
            }
        }
        return $ret;
    }
}