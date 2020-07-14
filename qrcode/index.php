<?php
/**
 * Notes:
 * File name:${fILE_NAME}
 * Create by: Jay.Li
 * Created on: 2020/6/22 0022 9:35
 */

require "../vendor/autoload.php";

use Endroid\QrCode\QrCode;

$qrCode = new QrCode('http://lglg.xyz');

header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();