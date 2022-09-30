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
                while ($i < $str_length and is_numeric($char)) {
                    $temp_nb = $temp_nb . $char;
                    $i += 1;
                    if($i < $str_length)$char = $str[$i];
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
        // consider first char as an operator
        $operator = $exp[0];
        // divide numbers by a space as an array elements
        $numbers = explode(' ', substr($exp, 2));
        $res = 0;
        // get the total count of numbers
        $num_length = count($numbers);
        //validating
        if ($num_length === 0) return $res;
        else if ($num_length === 1) return $numbers[0];
        else $res = $numbers[0];

        for ($i = 1; $i < count($numbers); $i++) {
            $num = $numbers[$i];
            // checking the operator for each number and affecting the whol result
            switch ($operator) {
                case '+':
                    $res += $num;
                    break;
                case '-':
                    $res -= $num;
                    break;
                case '*':
                    $res *= $num;
                    break;
                    // in case of '/' it would be considered  TRAILING SLASH to indicate a directory
                    // case '/':
                    //     $res /= $num;
                    //     break;
            }
        }

        return $res;
    }
}
