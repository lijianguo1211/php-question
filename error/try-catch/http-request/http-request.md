### PHP代码规范和异常处理



* 在PHP这个弱类型的语言中，使用一个变量时不需要去先声明，然后在去使用，它没有一个编译的过程，所有只有你运行你的代码的时候才会出现错误，还有很多时候是
声明了一个变量不去使用，或者就是使用一个不存在的变量。这样就很容易造成错误的发生几率。比如：

1. 偶尔看到的一些代码片段：

```php
class Test
{
    public $httpClient;

    protected function request($urlParam, array $data, $type = 'post', array $header = [])
        {
            try {
                $response = $this->httpClient->request($type, HOST_API_ROUTE . $urlParam, [
                    'headers'  => $this->requestHeader,
                    'json'     => $data,
                    'on_stats' => function (TransferStats $stats) {
                        $this->transferTime = $stats->getTransferTime();
                    },
                ]);
            } catch (\Exception $exception) {
                if ($exception instanceof RequestException) {
                    if ($exception->hasResponse()) {
                        $response = $exception->getResponse();
                    }
                }
                $excRes = $exception->getMessage();
            }
            if ($this->saveLog) {
                if ($response instanceof ResponseInterface) {
                    $cont = $response->getBody()->getContents();
                    $res = json_decode($cont, true);
                }
                if (is_null($res)) $res = $cont;
                if ($excRes && empty($res)) $res = $excRes;
                $this->log($urlParam, $data, $res);
                if (!is_array($res) || ($res['status'] != 300 && $res['Status'] != 300)) {
                    $this->log($urlParam, $data, $res, 'error');
                }
                if ($response instanceof ResponseInterface) {
                    $response->getBody()->rewind();
                }
            }
            return $response;
        }
}

```


































