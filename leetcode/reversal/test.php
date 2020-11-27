<?php

function reverse(int $number) {
    if ($number > pow(2, 31) - 1 || $number < pow(-2, 31)) {
        return 0;
    }

    if ($number < 10 && $number > -10) {
        return $number;
    }

    $status = $number < 0 ? '-' : '';

    $tempNum = abs($number) . '';

    $len = strlen($tempNum) - 1;

    $hafl = floor($len / 2);

    for ($i = 0; $i < $len; $i++) {
        $temp = $tempNum[$len - $i];
        $tempNum[$len - $i] = $tempNum[$i];
        $tempNum[$i] = $temp;

        if ($i == $hafl) {
            break;
        }
    }

    return $status . $tempNum;
}




//function reverse($x) {
//    if ($x > pow(2, 31) - 1 || $x < pow(-2, 31)) {
//        return 0;
//    }
//
//    if ($x <= 9  && $x > -9) {
//        return $x;
//    }
//
//    $status = $x < 0 ? '-' : '';
//
//    $tempNum = abs($x) . '';
//
//    if (strlen($tempNum) === 2) {
//        return $status . $tempNum[1] . $tempNum[0];
//    }
//
//    $len = strlen($tempNum) - 1;
//
//    $hafl = floor($len / 2);
//
//    for ($i = 0; $i < $len; $i++) {
//        if ($i == $hafl) {
//            break;
//        }
//
//        $temp = $tempNum[$len - $i];
//        $tempNum[$len - $i] = $tempNum[$i];
//        $tempNum[$i] = $temp;
//    }
//
//    $tempNum = $status . $tempNum;
//
//    return $tempNum;
//}

//$num = reverse(123456);
//
//var_dump($num);
//
//$num = reverse(-9644532);
//
//var_dump($num);

$num = reverse(-10);

var_dump($num);


function testReverse(string $num)
{
    $number = (string)abs($num);

    $len = strlen($number) - 1;

    $arr = [];
    for ($i = $len; $i >= 0; $i--) {
        $arr[] = $number[$i];
    }

    return implode('', $arr);
}

var_dump(testReverse(123456));

function testReverse1(int $number)
{
    $number = abs($number);

    $newNumber = 0;
    while ($number != 0) {
        $temp = $number % 10;
        $number = intval($number / 10);
        $newNumber = $newNumber * 10 + $temp;
        var_dump($newNumber);
    }

    return $newNumber;
}

var_dump(testReverse1(1478));

var_dump(pow(-2, 31));