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
        return $str;
    }
    public function calculateExpression($exp)
    {
        return $exp;
    }
}
