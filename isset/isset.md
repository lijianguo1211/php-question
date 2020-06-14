### 关于isset和逻辑运算符的使用

之前看到**Hyperf**的框架中，关于服务端的代码，有一个设置配置的文件的代码，如下：

```php
$config = ['host' => ''];

isset($config['host']) && $config['host'] = '127.0.0.1';
```

这个代码里是把``isset()``和逻辑运算符放在一起的，当这个`isset()`存在的时候，就会给它重新赋值，比起写`if`来说，代码看起来清爽了很多。比如
`if`的实现：

```php
$config = [];

if (isset($config['host'])) $config['host'] = '127.0.0.1';
if (isset($config['host'])) {
    $config['host'] = '127.0.0.1';
    }
```

上下一比较，感觉有点意思，至于性能什么的，这个我就不知道了，这样的其实一个逻辑判断，不仅可以是`isset()`,很多函数都可以这样写，比如`empty()`

```php
$config = [];

isset($config['host']) && $config['host'] = '127.0.0.1';

var_dump($config);

empty($config['host']) && $config['host'] = 'localhost';


var_dump($config);
```

性能的话，不知道怎么测试。如果单纯的是我这样测试的话：很明显是`if()`语句比逻辑运算符要快一些，欢迎大家来指正

```php
$config = ['host'];
$start = microtime(true);
echo  $start . PHP_EOL;
for ($i = 0; $i <= 10000; $i++) {
    isset($config['host']) && $config['host'] = '127.0.0.1' . $i;
}
$end = microtime(true);
echo  $end . PHP_EOL;

echo $end - $start . PHP_EOL;
$start1 = microtime(true);
echo  $start1 . PHP_EOL;
for ($i = 0; $i <= 10000; $i++) {
    if (isset($config['host'])) {
        $config['host'] = '127.0.0.1' . $i;
    }
}
$end1 = microtime(true);
echo  $end1 . PHP_EOL;

echo $end1 - $start1;
```