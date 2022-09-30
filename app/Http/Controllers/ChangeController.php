<?php

namespace App\Http\Controllers;

class ChangeController extends Controller
{
    public function sortString($str)
    {
        $lower = array();
        $upper = array();
        $numbers = array();
        $res = '';

        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];
            if (is_numeric($char)) {
                $numbers[] = $char;
            } else if (ctype_upper($char)) {
                $lower_ascii = ord(strtolower($char));
                empty($upper[$lower_ascii]) ? $upper[$lower_ascii] = 1 : $upper[$lower_ascii] += 1;
            } else if (ctype_lower($char)) {
                $lower_ascii = ord($char);
                empty($lower[$lower_ascii]) ? $lower[$lower_ascii] = 1 : $lower[$lower_ascii] += 1;
            }
        }
        sort($numbers);

        while ($lower or $upper) {
            $lower ? $min_lower = min(array_keys($lower)) : $min_lower = 1000;
            $upper ? $min_upper = min(array_keys($upper)) : $min_upper = 1000;

            if ($min_lower <= $min_upper) {
                $lower_char = chr($min_lower);
                for ($i = 0; $i < $lower[$min_lower]; $i++) $res .= $lower_char;
                unset($lower[$min_lower]);
            } else {
                $upper_char = chr($min_upper);
                for ($i = 0; $i < $upper[$min_upper]; $i++) $res .= strtoupper($upper_char);
                unset($upper[$min_upper]);
            }
        }

        foreach($numbers as $num) $res.=$num;
        return $res;
    }

    public function splitNumber($num)
    {
        $res = [];
        $numlength = strlen((string)$num);
        // iterate as much as the length of the string
        for ($i = 0; $i < $numlength; $i++) {
            //for each iteration take the remainder
            $rem = $num % 10;
            // update num to exclude last char
            $num = floor($num / 10);
            // add the remainder multiplied by 10 and '$i' as number with respect to the end of the number 
            $res[] = $rem * (10 ** $i);
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
            // first check the start of a number
            if (is_numeric($char)) {
                // store the number by looping on its digits and making sure we don't get out of the total string size
                $temp_nb = '';
                while ($i < $str_length and is_numeric($char)) {
                    $temp_nb = $temp_nb . $char;
                    $i += 1;
                    if ($i < $str_length) $char = $str[$i];
                } // when the whole number is stored in $temp_nb add it to the result as a binary
                $res = $res . decbin($temp_nb);
            } else { //whenever we don't have a number add it to the result directly
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
