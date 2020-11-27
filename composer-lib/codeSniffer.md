### PHP代码检测工具 **CodeSniffer**

* 使用composer安装 `composer require squizlabs/php_codesniffer`

* [git拉取下载](https://github.com/squizlabs/PHP_CodeSniffer.git) `https://github.com/squizlabs/PHP_CodeSniffer.git`

* 最主要的是两个文件：

```
|-- squizlabs
    |-- php_codesniffer
        |-- bin
            |-- phpcbf //代码修正脚本
            |-- phpcbf.bat
            |-- phpcs //代码检测脚本
            |-- phpcs.bat
```

* 运行检测文件的参数查看 ``./bin/phpcs -h | --help``

* 运行代码修复脚本参数参看 ``./bin/phpcbf -h | --help``

* 查看版本信息 ``./bin/phpcs --version``

* 比如检测一个文件可以直接运行 ``./bin/phpcs ./test`` 检测当前目录下的test目录，也可以检测一个文件，把目录换为具体的文件名

* 运行时设置编码格式 ``./bin/phpcs --encoding=utf-8``

* 检测结果不打印`warning`信息 ``./bin/phpcs -n ./test``

* 动态显示检测进度 ``./bin/phpcs -p ./test``

* 打印错误和警告信息，默认配置，不需要修改 ``./bin/phpcs -w ./test``

* 参数 ``-l`` 无递归的检查，仅检查当前目录 ``./bin/phpcs -l ./test``

* 参数 ``-s`` 详细的显示每个文件的具体问题 ``./bin/phpcs -s ./test``

* 参数 ``-a`` 交互式运行，一般有三个选项 重新检测，跳过，退出 ``./bin/phpcs -a ./test``

* 参数 ``-i`` 显示已安装的编码标准  ``./bin/phpcs -i ./test`` 

``
The installed coding standards are MySource, PEAR, PSR1, PSR12, PSR2, Squiz and Zend
``

* 参数 ``--colors`` 设置输出的颜色

* 参数 ``--no-colors`` 不设置输出的颜色，默认配置

* 参数 ``--cache`` 缓存输出结果

* 参数 ``--no-cache`` 不缓存输出结果，默认配置

* 参数 ``--ignore-annotations`` 忽略代码注释

* 参数 ``--report=summary`` 仅显示每个文件的错误和警告数量的摘要报告
* 参数 ``--report=souurce`` 打印源报告
* 参数 ``--report=info`` 打印详细信息报告
* 参数 ``--report=ocde`` 打印代码报告

* 更多 ``--report``参数 `Checkstyle`,`csv`, `Emacs`, `git`, `json`, `JUnit`, `svn`, `xml`

* 讲检测结果写入文件 ``--report-full=`` 后面是文件路径

* 参数 ``--standard`` 设置检测文件时使用的编码标准 ``./bin/phpcs --standard=psr2 ./test`` 

* 参数 ``-e`` 和参数 ``--standard=psr2`` 配合使用，可以打印出当前文件需要做那些标砖的检查

* 参数 ``--extensions`` 只检查当前列出的文件后缀的文件 ``./bin/phpcs --extensions=php --standard=psr2 ./test``

* 参数 ``--severity`` 显示打印消息的等级，默认为5 ``./bin/phpcs --severity=2 ./test``

* 参数 ``--config-set``修改配置选项











