### 关于时间PHP处理包遇到的问题

1. 问题描述，最近在写项目的时候，因为是一个多语言的项目，而且对于本地化时间也做了处理，再加上在宣传页面，不同的地方，做了不同格式的展示时间的
处理，最重要一点，这是一个使用laravel开发的项目，安装一个方便的时间处理包真的是太方便了，而且`carbon`还是这么的强大。

2. 后台的使用者在发布一个宣传文章的时候，有时候会使用一个预发布的功能，那么前台在预发布的时间之后，就会显示这个宣传文章，现在的问题就是，比如
我选择一个早上八点之前的预发布时间，那么使用`carbon`处理时间之后，这个显示的时间，会比预发布的时间晚一天。如果选择早上八点之后，最后格式话的
时间就是正常的。

3. 在配置文件里，`app.php`我配置的时区是 `PRC`,做本地化处理的时候，

```php
//这个地方是根据站点的切换来动态切换
Carbon::setLocale('en');

$time1 = Carbon::parse(strtotime('2020-06-12 06:00:00'))->isoFormat('LL');
var_dump($time1);
$time2 = Carbon::parse(strtotime('2020-06-12 07:00:00'))->isoFormat('LL');
var_dump($time2);
$time3 = Carbon::parse(strtotime('2020-06-12 09:00:00'))->isoFormat('LL');
var_dump($time3);

//June 11, 2020
//June 11, 2020
//June 12, 2020
```

4. 这个例子得到的处理之后的时间就是晚一天的，它会减去八个小时

5. 如果是我这样处理就不会有问题

```php
//这个第二个参数就是动态切换的
$carbon = new Carbon('2020-08-06 06:00:00', 'en');
$carbon->isoFormat('LL');
//or
$time1 = Carbon::parse('2020-06-12 06:00:00')->isoFormat('LL');
var_dump($time1);
$time2 = Carbon::parse('2020-06-12 06:00:00')->isoFormat('LL');
var_dump($time2);
$time3 = Carbon::parse('2020-06-12 06:00:00')->isoFormat('LL');
var_dump($time3);
```

这个打印出来时间就是正常的,问题就是出在是否使用了php的自带函数`strtotime()`。我如果传一个时间戳过去，这个时候时间的转换就会出现差错，如果
传一个时间戳，就会走到这一步：

```php
public function __construct($time = null, $tz = null)
    {
        if (is_int($time)) {
            $time = "@$time";
        }

        $originalTz = $tz;

        // If the class has a test now set and we are trying to create a now()
        // instance then override as required
        $isNow = empty($time) || $time === 'now';

        if (method_exists(static::class, 'hasTestNow') &&
            method_exists(static::class, 'getTestNow') &&
            static::hasTestNow() &&
            ($isNow || static::hasRelativeKeywords($time))
        ) {
            static::mockConstructorParameters($time, $tz);
        }

        /** @var CarbonTimeZone $timezone */
        $timezone = $this->autoDetectTimeZone($tz, $originalTz);

        // Work-around for PHP bug https://bugs.php.net/bug.php?id=67127
        if (strpos((string) .1, '.') === false) {
            $locale = setlocale(LC_NUMERIC, '0');
            setlocale(LC_NUMERIC, 'C');
        }

        parent::__construct($time ?: 'now', $timezone);

        if (isset($locale)) {
            setlocale(LC_NUMERIC, $locale);
        }

        static::setLastErrors(parent::getLastErrors());
    }
```

这个`__construct`方法会继承父类的`__construct()`,而它在传递给父类的时候，会检测时间戳是否是一个`int`类型，如果是就会转换为字符串的类型
这个时候，父类`DateTime::__construct` [DateTime](https://www.php.net/manual/zh/datetime.construct.php)在处理的时候，再格式话
输出时间的时候，就会出现时间查。

6. 总结，追了一圈才发现不是`carbon`的bug,同时也发现了这个问题，再下次使用时间戳的时候，需要注意，禁忌