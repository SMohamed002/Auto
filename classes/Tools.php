<?php

class Tools
{

    public static function array_change_key_case_recursive($arr, $case = CASE_LOWER)
    {
        return array_map(function ($item) use ($case) {
            if (is_array($item))
                $item = Tools::array_change_key_case_recursive($item, $case);
            return $item;
        }, array_change_key_case($arr, $case));
    }

    public static function array_change_key_case_unicode($arr, $c = CASE_LOWER)
    {
        $c = ($c == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
        foreach ($arr as $k => $v) {
            $ret[mb_convert_case($k, $c, "UTF-8")] = $v;
        }
        return $ret;
    }

    public static function array_change_key_case_unicode_recurs($arr, $c = CASE_LOWER)
    {
        foreach ($arr as $k => $v) {
            $ret[mb_convert_case($k, (($c === CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER), "UTF-8")] = (is_array($v) ? Tools::array_change_key_case_unicode_recurs($v, $c) : $v);
        }
        return $ret;
    }
}