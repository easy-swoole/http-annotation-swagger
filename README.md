<p align="center">
    <a href="https://www.easyswoole.com/" target="_blank">
        <img src="https://raw.githubusercontent.com/easy-swoole/easyswoole/3.x/easyswoole.png" height="100px">
    </a>
    <h1 align="center">EasySwoole Http Annotation Swagger </h1>
    <br>
</p>

Install
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require easyswoole/http-annotation-swagger
```

or add

```
"easyswoole/http-annotation-swagger": "dev-master"
```
to the require section of your `composer.json` file.

Config
-----------
dev.php add
```php
<?php
    return [
            'swagger' => [
                'info' => [
                    'title' => '测试用例',
                    'version' => '1.0.0',
                    'contact' => ['name' => 'aaa'],
                ],
                'servers' => [
                    [
                        'url' => 'http://127.0.0.1:9501',
                        'description' => '本地环境'
                    ]
                ],
                'templates' => [
                    'success' => [
                        'code|状态码' => "0",
                        'result|api请求结果' => "{template}",
                        'msg|api提示信息' => 'success'
                    ],
                    'page' => [
                        'code|状态码' => "0",
                        'result|api请求结果' => [
                            'totalPage|总页数' => 10,
                            'page|页数' => 1,
                            'list|列表' => ["{template}"],
                        ],
                        'msg|api提示信息' => 'success'
                    ],
                ],
            ]
        ];
```

Use
--------------
xxxController.php  

```php
    <?php
        
        ....
        use EasySwoole\EasySwoole\Config;
        use EasySwoole\Spl\SplArray;
        use EasySwoole\HttpAnnotation\Swagger\AnnotationParser;
        use EasySwoole\HttpAnnotation\Swagger\GenerateSwagger;
        ....

        public function swagger()
        { 
             $config = new SplArray(Config::getInstance()->getConf("swagger"));
             $annotationParser = new AnnotationParser(EASYSWOOLE_ROOT . '/App/HttpController');
             $swagger = new GenerateSwagger($config, $annotationParser);
            
              // generate swagger.json
             $data = $swagger->scan2Json();
             $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
             $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
             $this->response()->withStatus(200);
            
             // or

             // generate swagger.html
             $string = $swagger->scan2Html();
             $this->response()->withAddedHeader('Content-type', "text/html;charset=utf-8");
             $this->response()->write($string);
        }   

```

Annotation `ApiSuccessTemplate` Use  
----------------
xxxController.php  
```php
    <?php
    
    ....
    use EasySwoole\HttpAnnotation\Swagger\Annotation\ApiSuccessTemplate;

    ....
    

    /**
     * @Api(name="update",path="/Api/Admin/AdminUser/update")
     * @ApiDescription("更新数据")
     * @Method(allow={GET,POST})
     * @InjectParamsContext(key="param")
     * @ApiSuccessParam(name="code",description="状态码")
     * @ApiSuccessParam(name="result",description="api请求结果")
     * @ApiSuccessParam(name="msg",description="api提示信息")
     * @ApiSuccess({"code":200,"result":[],"msg":"更新成功"})
     * @ApiSuccessTemplate(template="page", result={
     *      "a|这是一个测试": 1,
     *      "b|第二个测试": "1"
     *    })
     * @ApiFail({"code":400,"result":[],"msg":"更新失败"})
     * @Param(name="adminId",alias="id",description="id",required="")
     * @Param(name="adminName",alias="昵称",description="昵称",lengthMax="32",optional="")
     * @Param(name="adminAccount",alias="账号",description="账号",lengthMax="32",optional="")
     * @Param(name="adminPassword",alias="密码",description="密码",lengthMax="32",optional="")
     */
    public function update()
    {
        
    }

```



