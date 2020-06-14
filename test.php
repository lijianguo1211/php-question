<?php

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
