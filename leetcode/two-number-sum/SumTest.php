<?php


class SumTest
{
    /**
     * Notes:
     *
     * 给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，并返回他们的数组下标。
     * 你可以假设每种输入只会对应一个答案。但是，数组中同一个元素不能使用两遍
     * Name: twoSum
     * User: LiYi
     * Date: 2020/6/21
     * Time: 23:18
     * @param $nums
     * @param $target
     * @return array
     */
    public function twoSum($nums, $target)
    {
        $result = [];

        $count = count($nums);

        if (!$count) {
            return [];
        }

        foreach ($nums as $key => $num) {
            $diff = $target - $num;
            if (isset($result[$diff]) && ($nums[$result[$diff]] + $num === $target)) {
                return [$result[$diff], $key];
            } else {
                $result[$num] = $key;
            }
        }

        return [];
    }
}

$obj = new SumTest();
$nums = [2, 7, 11, 15, 0];
$target = 11;
$result = $obj->twoSum($nums, $target);

var_dump($result);