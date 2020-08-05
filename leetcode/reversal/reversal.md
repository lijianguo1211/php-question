### 字符串或数字反转

* 字符串反转，比如给定一个字符串 `abc`,得到一个`cba`，或者输入一个`123456`得到一个`654321`,如果不想要自己实现，那么`PHP`有一个自带的函数
``strrev ( string $string ) : string`` [strrev](https://www.php.net/manual/zh/function.strrev.php) 也是可以达到相同的效果的

* 在 [力扣](https://leetcode-cn.com/problems/reverse-integer/) 算法篇是由这个题目描述的，具体的可以点链接过去看看，不过这个题目在里
算法里面是属于**简单**的

* 在这里如果想要自己实现一个达到相同效果的函数，也是可以做到的。

1. 方法一：使用二分法，我们把第一个字符和最后一个字符交换位置，然后第二个字符和倒数第二个字符交换位置，直到达到中间的位置，代表已经转换位置
完成，这样就可以达到字符串反转的效果了。 

2. 在力扣中，需要反转的是一个整数，整数的范围是  [−2<sup>31</sup>,&nbsp; 2<sup>31&nbsp;</sup>− 1]，所以第一步可以先判断整数是否在范围
之内，不在直接返回0

```php
function reverse(int $number) {
    if ($number > pow(2, 31) - 1 || $number < pow(-2, 31)) {
        return 0;
    } 
}
```

3. 再次判断输入的这个数字是不是一个个位数，如果是个位数，那就直接返回吧

```php
if ($number < 10 || $number > -10) {
    return $number;
}
```

4. 首先判断一下输入过来的数字是正数还是负数，然后把这个正数还是负数的状态保存下来，最后返回的时候会使用到,如果是一个小于0的数字，那么就保存为
1，如果是一个大于等于0的数字那就保存为0

```php
 $status = $number < 0 ? '-' : ''; 
```

5. 得到一个没有符号的数字，就是去掉输入数字的符号，可以直接使用`php`的求绝对值的函数，`abs()`

```php
$tempNum = abs($number) . '';
```

6. 得到去掉符号数字的长度，下面做`for`循环使用

```php
$len = strlen($tempNum) - 1;
```

7.求得长度的`1/2`，还是为了`for`循环使用，是循环的终止条件

```php
$hafl = floor($len / 2);
``` 

8. 开始`for`循环，先写出终止条件,当当前的指针指向数字的最中间的数字时，代表互换位置完成了

```php
for ($i = 0; $i < $len; $i++) {
    if ($i === $hafl) {
        break;
    }
    $temp = $tempNum[$len - $i];
    $tempNum[$len - $i] = $tempNum[$i];
    $tempNum[$i] = $temp;

}
```

9. 最后把上面的状态加上，返回这个数字

```php
return $status . $tempNum;
```

10. 完整的代码如下：

```php
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

$num = reverse(123456);

var_export($num);

$num = reverse(-9644532);

var_export($num);
```

* 还有一种数组的实现方式，主要的思路就是把整数变为字符串，然后循环这个字符串的长度，倒置循环，把最后的一个字符放在数组的第一个位置，最后把得
到的数组通过内置函数分割为字符串就可以完成了，缺点就是当数字或字符串很长的时候，就会很占用内存，然后程序就会挂掉，但是如果是都放到这个力扣的
解法中，还是可以的。

```php
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
```

* 第三种方法是通过一个`while()`循环，在循环内部对这个整数以10取模`$number % 10`,再不断的以10为被除数，最后的终止条件就是得到的商转化为整
数如果为0,终止循环

```php
function testReverse1(int $number)
{
    $number = abs($number);

    $newNumber = 0;
    while ($number != 0) {
        $temp = $number % 10;
        $number = intval($number / 10);
        $newNumber = $newNumber * 10 + $temp;
    }

    return $newNumber;
}

var_dump(testReverse1(1478));
```

