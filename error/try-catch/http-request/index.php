<?php
/**
 * Notes:
 * File name:${fILE_NAME}
 * Create by: Jay.Li
 * Created on: 2020/7/23 0023 9:43
 */

define('APP_PATH', dirname(dirname(dirname(__DIR__))));



interface HttpParameterInterface
{
    const RETRIEVE_FOUNDS_POOL = '?script=337&deploy=1'; // 调AR资金池
    const RETRIEVE_FOUNDS_POOL_ONLINE = '?script=337&deploy=1'; // 调AR资金池-线上
    const BASE_URI = 'http://5666129-sb1.restlets.api.netsuite.com';
    const NS_HOST_API_ROUTE = 'app/site/hosting/restlet.nl';//'NS_HOST_API_ROUTE', 'app/site/hosting/restlet.nl'
}

require APP_PATH . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use SimpleSoftwareIO\QrCode\Generator as QrCode;

class HttpClient
{
    public $httpRequest;

    public function __construct()
    {
        $this->connect();
    }


    public function connect()
    {
        try {
            $this->httpRequest = new Client([
                'base_uri'    => HttpParameterInterface::BASE_URI,
                'http_errors' => true,
                'timeout'     => 300
            ]);
        } catch (\Exception $e) {
            $this->httpRequest = null;
            var_dump("http connect error !" . $e->getMessage());
        }
    }

    public function getRequest(string $uri)
    {
        try {
            $response = $this->httpRequest->request('get', $uri);
            $message = '';
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $message = $e->getMessage();
        } catch (\Exception $e) {
            $response = new class {
                public function getStatusCode()
                {
                    return 500;
                }

                public function getResponse()
                {
                    return null;
                }
            };
            $message = $e->getMessage();
        }

        return $response;
    }
}

ini_set('error_reporting', E_ALL ); // log only errors according to defined rules
ini_set('log_errors', 1);          // store to file
ini_set('log_errors_max_len', 0);  // unlimited length of message output
ini_set('display_errors', 0);      // do not output errors to screen/browser/client
ini_set('error_log', APP_PATH . '/log/' . date('Y-m-d') . '.log');  // the filename to log errors into




$qrcode = new QrCode();

$res = $qrcode->format('png')
    ->size(200)
//    ->color('', '', '', '')
//    ->backgroundColor('', '', '', '')
    ->encoding('utf-8')
//    ->merge('./timg.jpg')
    ->mergeString('LIYI')
    ->generate('http://www.lglg.xyz', './phone.png');



