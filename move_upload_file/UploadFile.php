<?php
/**
 * Notes:
 * File name:UploadFile
 * Create by: Jay.Li
 * Created on: 2020/6/19 0019 9:24
 */


class UploadFile extends SplFileInfo
{
    public function __construct($file_name)
    {
        parent::__construct($file_name);
    }

    public function upload()
    {
        $ext = $this->getExtension();

        $file = $this->getFilename();

        var_dump($ext);

        var_dump($file);
    }
}

$fileName = $_FILES;

echo "<pre>";
var_dump($fileName);
$file = __DIR__ . '/upload/';

if (!is_dir($file)) {
    mkdir($file);
}

$str = $fileName['file_name']['name'];

var_dump($file);
try {
    $temp = $fileName['file_name']['tmp_name'];
    if(file_exists($temp)) {
        var_dump($temp);
    } else {
        var_dump('not exists file');
    }
    $source = $file . $fileName['file_name']['name'];
    $source = iconv("UTF-8","GBK//IGNORE", $source);
    //copy($fileName['file_name']['tmp_name'], $file . $fileName['file_name']['name']);
    move_uploaded_file($fileName['file_name']['tmp_name'], $source);
} catch (\Exception $exception) {
    var_dump(error_get_last());
    var_dump($exception->getMessage());
}
