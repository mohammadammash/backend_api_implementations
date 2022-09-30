<?php

namespace App\Http\Controllers;

class ChangeController extends Controller
{
    public function sortString($str)
    {
        return $str;
    }
    public function splitNumber($num)
    {
        $res = [];
        $numlength = strlen((string)$num);
        for ($i = 0; $i < $numlength; $i++) {
            $diff = $num % 10;
            $num = floor($num / 10);
            $res[] = $diff * (10 ** $i);
        }
        return response()->json(
            [
                'status' => 'success',
                'message' => array_reverse($res)
            ]
        );
    }

    public function translateToBinary($str)
    {
        $res = '';
        $str_length = strlen($str);
        $i = 0;

        while ($i < $str_length) {
            $char = $str[$i];

            if (is_numeric($char)) {
                $temp_nb = '';
                while (is_numeric($char) and $i < $str_length) {
                    $char = $str[$i];
                    $temp_nb = $temp_nb . $char;
                    $i += 1;
                }
                $res = $res . decbin($temp_nb);
            } else {
                $res = $res . $char;
                $i += 1;
            }
        }
        return $res;
    }

    public function calculateExpression($exp)
    {
        return $exp;
    }
}
