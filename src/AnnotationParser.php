<?php

namespace EasySwoole\HttpAnnotation\Swagger;

use EasySwoole\HttpAnnotation\Annotation\MethodAnnotation;
use EasySwoole\HttpAnnotation\Swagger\Annotation\ApiSuccessTemplate;
use EasySwoole\HttpAnnotation\Swagger\Property\Swagger;
use EasySwoole\HttpAnnotation\Swagger\Property\Tag;
use EasySwoole\HttpAnnotation\Annotation\ObjectAnnotation;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;
use EasySwoole\HttpAnnotation\Utility\Scanner;
use EasySwoole\Spl\SplArray;

class AnnotationParser implements AnnotationParserInterface
{
    /**
     * @var string $path 扫描目录
     *
     */
    protected $path;
    /**
     * @var Swagger
     */
    protected $swagger;
    /**
     * 媒体类型
     * @var string[]
     */
    protected $contentTypes = [
        'application/json',
        'application/x-www-form-urlencoded',
        'multipart/form-data',
        'application/xml',
    ];

    /**
     * @var array
     */
    protected $accepts = [
        'application/json',
        'text/html',
        'image/*',
        'application/xml',
        '*/*',
    ];

    /**
     * @var array $tags
     * @link Tag
     */
    protected $tags = [];

    /**
     * @var array $securities
     * @link SecurityDefinition
     */
    protected $securities = [];

    /**
     * @var array
     * @link Request
     */
    protected $parameters = [];

    /**
     * @var array
     */
    protected $templates = [];

    /**
     * @var SwaggerParser
     */
    protected $swaggerParser;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->swaggerParser = new SwaggerParser();;
    }

    /**
     * @param Swagger $swagger
     */
    public function setSwagger(Swagger $swagger)
    {
        $this->swagger = $swagger;
    }

    /**
     * @return string[]
     */
    public function getContentTypes(): array
    {
        return $this->contentTypes;
    }

    /**
     * @param string[] $contentTypes
     *
     * @return AnnotationParser
     */
    public function setContentTypes(array $contentTypes): AnnotationParser
    {
        if (!empty($contentTypes)) {
            $this->contentTypes = $contentTypes;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getAccepts(): array
    {
        return $this->accepts;
    }

    /**
     * @param array $accepts
     *
     * @return AnnotationParser
     */
    public function setAccepts(array $accepts): AnnotationParser
    {
        if (!empty($accepts)) {
            $this->accepts = $accepts;
        }
        return $this;
    }

    /**
     * @param array $templates
     *
     * @return AnnotationParser
     */
    public function setTemplates(array $templates): AnnotationParser
    {
        $this->templates = $templates;
        return $this;
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @param ObjectAnnotation $objectAnnotation
     *
     * @return array
     */
    protected function checkTag(ObjectAnnotation $objectAnnotation): array
    {
        if (empty($this->tags)) {
            foreach ($this->swagger->getTags() as $item) {
                $this->tags[] = $item->getName();
            }
        }

        $currentGroupName = 'default';
        if ($objectAnnotation->getApiGroupTag()) {
            $currentGroupName = $objectAnnotation->getApiGroupTag()->groupName;
        }

        if (in_array($currentGroupName, $this->tags)) {
            return [$currentGroupName];
        }

        $description = '';
        $groupDescTag = $objectAnnotation->getApiGroupDescriptionTag();
        if ($groupDescTag) {
            $description = $this->parseDescTagContent($groupDescTag);
        }

        $tag = new Tag();
        $tag->setName($currentGroupName)->setDescription($description);
        $this->swagger->addTag($tag);

        $this->tags[] = $tag->getName();
        return [$currentGroupName];
    }

    /**
     * @param array $authTagLists
     *
     * @return array
     */
    protected function checkSecurities(array $authTagLists): array
    {
        if (empty($authTagLists)) {
            return [];
        }
        if (empty($this->securities)) {
            foreach ($this->swagger->getComponents()->getSecuritySchemes() ?? [] as $name => $securityDefinition) {
                $scopes = [];
                foreach ($securityDefinition->getFlows() as $flow) {
                    $scopes = $flow->getScopes();
                }
                $this->securities[$name] = $scopes;
            }
        }
        $auth = $ignoreAction = [];
        foreach ($authTagLists as $authTagList) {
            $auth[$authTagList->name] = $authTagList->name;
            $ignoreAction[$authTagList->name] = $authTagList->ignoreAction ?? [];
            if (array_key_exists($authTagList->name, $this->securities) > 0) {
                continue;
            }
            $this->securities[$authTagList->name] = [];
            // 权限 默认 都为 api_key  header, key 为 name
            // todo 等注解支持 in 的时候 在修改， 也可以在配置参数设置权限， 反正boss又不会看代码，告辞
            $security = $this->swaggerParser->securityScheme([
                'type'        => 'apiKey',
                'name'        => $authTagList->name,
                'description' => $authTagList->description,
                'in'          => 'header',
            ], $authTagList->name);
            $this->swagger->getComponents()->addSecurityScheme($security);
        }
        return [
            'auth'         => $auth,
            'ignoreAction' => $ignoreAction,
        ];
    }

    /**
     * @param array  $globalAuth
     * @param array  $groupAuth
     * @param array  $actionAuth
     * @param string $actionName
     *
     * @return array
     */
    protected function getSecurities(array $globalAuth, array $groupAuth, array $actionAuth, string $actionName): array
    {
        // actionAuth > groupAuth > globalAuth
        $auths = $ignoreActions = [];
        if ($globalAuth) {
            $auths = $globalAuth['auth'];
        }

        if ($groupAuth) {
            $auths = array_merge($auths, $groupAuth['auth']);
            $ignoreActions = $groupAuth['ignoreAction'];
        }

        if ($actionAuth) {
            $auths = array_merge($auths, $actionAuth['auth']);
        }

        $data = [];
        foreach ($auths as $auth) {
            $ignoreAction = $ignoreActions[$auth] ?? [];
            if (empty($actionAuth['auth'][$auth]) && in_array($actionName, $ignoreAction)) {
                continue;
            }
            $data[$auth] = $this->securities[$auth];
        }
        return $data;
    }

    /**
     * @param $content
     *
     * @return false|mixed|string
     */
    protected function descTagContentFormat($content)
    {
        if (is_array($content)) {
            return json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        $json = json_decode($content, true);
        if ($json) {
            $content = json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            libxml_disable_entity_loader(true);
            $xml = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOERROR | LIBXML_NOCDATA);
            if ($xml) {
                $content = $xml->saveXML();
            }
        }
        return $content;
    }

    /**
     * @param ApiDescription|null $apiDescription
     *
     * @return false|mixed|string|null
     */
    protected function parseDescTagContent(?ApiDescription $apiDescription = null)
    {
        if ($apiDescription == null) {
            return null;
        }
        $ret = null;
        if ($apiDescription->type == 'file' && file_exists($apiDescription->value)) {
            $ret = file_get_contents($apiDescription->value);
        } else {
            $ret = $apiDescription->value;
        }
        $ret = $this->descTagContentFormat($ret);
        return $ret;
    }

    protected function parseParam(Param $param)
    {
        $schema = [
            'type'        => null,
            'title'       => $param->name,
            'description' => $param->description,
            'minLength'   => $param->lengthMin,
            'maxLength'   => $param->lengthMax,
            'minimum'     => (float)$param->min,
            'maximum'     => (float)$param->max,
            'pattern'     => $param->regex,
            'default'     => $param->defaultValue,
        ];

        if ($param->float) {
            $schema['type'] = 'number';
        }
        if ($param->integer) {
            $schema['type'] = 'integer';
        }
        if ($param->bool) {
            $schema['type'] = 'bool';
        }
        if ($param->float || $param->decimal || $param->numeric || $param->money) {
            $schema['type'] = 'number';
        }
        if (is_null($schema['type'])) {
            $schema['type'] = $param->type ?? 'string';
        }

        if (!empty($schema['default'])) {
            $schema['example'] = $schema['default'];
        }
        if (!empty($param->inArray[0])) {
            $schema['enum'] = $param->inArray[0];
        }
        if ($schema['type'] === 'int') {
            $schema['type'] = 'integer';
        }
        if (in_array($schema['type'], ['float', 'double'])) {
            $schema['type'] = 'number';
        }
        return $schema;
    }

    /**
     * @param Param  $param
     * @param string $in
     *
     * @return array
     */
    protected function parseParamTag(Param $param, string $in): array
    {
        $schema = $this->parseParam($param);
        $schema['required'] = !is_null($param->required);
        return [
            'name'            => $param->name,
            'in'              => $in,
            'description'     => $param->description,
            'allowEmptyValue' => !$param->notEmpty,
            'schema'          => $schema,
            'required'        => !is_null($param->required),
        ];
    }

    protected function arraySet(array &$array, $path, $value)
    {
        if ($path === null) {
            $array = $value;
            return;
        }
        $keys = is_array($path) ? $path : explode('.', $path);

        while (count($keys) > 1) {
            $key = array_shift($keys);
            if ($key === '*') {
                $key = '{%template%}';
            }
            if (!isset($array[$key])) {
                $array[$key] = [];
            }
            if (!is_array($array[$key])) {
                $array[$key] = [$array[$key]];
            }
            $array = &$array[$key];
        }
        $lastKey = array_shift($keys);
        if ($lastKey === '*') {
            $lastKey = '{%template%}';
        }
        $array[$lastKey] = $value;
    }

    protected function parseParamBody(array $params)
    {
        $required = $properties = [];
        $data = $parseParams = [];
        foreach ($params as $param) {
            $names = explode('.', $param->name);
            if (count($names) > 1) {
                $parseParams[':' . $param->name] = $param;
                $this->arraySet($data, $names, ':' . $param->name);
            } else {
                if (!is_null($param->required)) {
                    $required[] = $param->name;
                }
                $properties[$param->name] = $this->parseParam($param);
            }
        }
        $data = str_replace("{%template%}", 0, json_encode($data));
        $data = json_decode($data, true);
        foreach ($data as $filed => $item) {
            $properties[$filed] = $this->parseParams($item, false, $parseParams);
        }
        $contents = [];
        foreach ($this->getContentTypes() as $mediaType) {
            $contents[$mediaType] = [
                'schema' => [
                    'properties' => $properties,
                    'required'   => $required,
                ],
            ];
        }
        return [
            'content' => $contents,
        ];
    }

    /**
     * @param array $array
     * @param bool  $consecutive
     *
     * @return bool
     */
    protected function isIndexed(array $array, bool $consecutive = false): bool
    {
        if ($array === []) {
            return true;
        }

        if ($consecutive) {
            return array_keys($array) === range(0, count($array) - 1);
        }

        foreach ($array as $key => $value) {
            if (!is_int($key)) {
                return false;
            }
        }

        return true;
    }

    protected function typeCast($val)
    {
        switch (gettype($val)) {
            case null:
            {
                return (string)$val;
            }
            case 'object':
            case 'array':
            {
                foreach ($val as $key => $v) {
                    $k = explode('|', $key);
                    unset($val[$key]);
                    $val[$k[0]] = $v;
                }
                return $val;
            }
            default:
            {
                return $val;
            }
        }
    }

    protected function getType($val)
    {
        $type = gettype($val);
        if (in_array($type, ['double', 'float'])) {
            $type = 'number';
        }
        return $type;
    }

    protected function parseParams($params, bool $isExample = true, array $parseParams = [])
    {
        $type = $this->getType($params);
        if ($type !== 'array') {
            if (!empty($parseParams[$params]) && $parseParams[$params] instanceof Param) {
                $content = $this->parseParam($parseParams[$params]);
            } else {
                $content = [
                    'type' => $type === 'object' ? 'string' : $type,
                ];
            }
        } else {
            if ($this->isIndexed($params)) {
                $param = !empty($params) ? current($params) : [];
                $paramItems = [];
                $content = [
                    'type' => 'array',
                ];
                if (!empty($param)) {
                    if (!empty($parseParams[$param]) && $parseParams[$param] instanceof Param) {
                        $paramItems = new SplArray($this->parseParam($parseParams[$param]));
                    } else {
                        $paramItems = $this->parseParams($param, false, $parseParams);
                    }
                }
                if (isset($paramItems['params'])) {
                    $content['params'] = [$paramItems['params']];
                    unset($paramItems['params']);
                }
                $content['items'] = $paramItems;
            } else {
                $properties = [];
                $check = false;
                foreach ($params as $key => $value) {
                    $item = $this->parseParams($value, false, $parseParams);
                    if (isset($item['params'])) {
                        $params[$key] = $item['params'];
                        unset($item['params']);
                    }
                    $k = explode('|', $key);
                    if (isset($k[1])) {
                        $item['description'] = $k[1];
                        $check = true;
                        $params[$k[0]] = $params[$key];
                        unset($params[$key]);
                    }
                    $properties[$k[0]] = $item;
                }
                $content = [
                    'type'       => 'object',
                    'properties' => $properties,
                ];
                if ($check) {
                    $content['params'] = $params;
                }
            }
            if ($isExample) {
                $content['example'] = $this->typeCast($params);
            }
        }
        return $content;
    }

    protected function parseData($params, string $key)
    {
        $content = $this->parseParams($params);
        if (isset($content['params'])) {
            unset($content['params']);
        }
        $contents = [];
        foreach ($this->getAccepts() as $accept) {
            $contents[$accept] = [
                'schema' => $content,
            ];
        }
        return [
            'description' => $key,
            'content'     => $contents,
        ];
    }

    public function parser(): array
    {
        $data = [];
        $apiSuccessTemplate = new ApiSuccessTemplate();
        $scanner = new Scanner();
        $scanner->getParser()->getAnnotation()->addParserTag($apiSuccessTemplate);
        $list = $scanner->scanAnnotations($this->path);

        /**
         * @var ObjectAnnotation $objectAnnotation
         */
        foreach ($list as $objectAnnotation) {
            // 全局参数
            $globalAuth = $paramTags = [];
            $onRequest = $objectAnnotation->getMethod('onRequest');
            if ($onRequest instanceof MethodAnnotation) {
                $paramTags = $onRequest->getParamTag();
                $globalAuth = $this->checkSecurities($onRequest->getApiAuth());
            }

            // group 参数
            $groupAuth = $this->checkSecurities($objectAnnotation->getGroupAuthTag());
            $paramTags = array_merge($paramTags, $objectAnnotation->getParamTag());
            $tags = [];
            //遍历全部方法
            /**
             * @var                  $methodName
             * @var MethodAnnotation $method
             */
            foreach ($objectAnnotation->getMethod() as $methodName => $method) {
                //仅仅渲染有api标记的方法
                $apiTag = $method->getApiTag();
                if (!$apiTag) {
                    continue;
                }
                if (empty($tags)) {
                    $tags = $this->checkTag($objectAnnotation);
                }
                $methods = $method->getMethodTag();
                $parameters = [];
                $methodParamTags = array_merge($paramTags, $method->getParamTag());
                preg_match_all('/(?<=\{)[^\}]+(?=\})/', $apiTag->path, $matches);
                if (!empty($matches[0])) {
                    foreach ($matches[0] as $match) {
                        if (empty($methodParamTags[$match])) {
                            continue;
                        }
                        $pathParams = $methodParamTags[$match];
                        unset($methodParamTags[$match]);
                        $parameters[] = $this->parseParamTag($pathParams, 'path');
                    }
                }
                foreach ($methodParamTags as $paramTagName => $methodParamTag) {
                    if (in_array('COOKIE', $methodParamTag->from) || in_array('cookie', $methodParamTag->from)) {
                        $parameters[] = $this->parseParamTag($methodParamTag, 'cookie');
                        unset($methodParamTags[$paramTagName]);
                    }
                }
                $responses = [];
                foreach ($method->getOtherTags()[$apiSuccessTemplate->tagName()] ?? [] as $item) {
                    $template = $item->template;
                    $result = $item->result;
                    if (is_null($template) || empty($this->getTemplates()) || empty($this->getTemplates()[$template])) {
                        $templateData = [
                            'code'   => $item->code,
                            'result' => is_null($result) ? '' : $result,
                            'msg'    => $item->msg,
                        ];
                    } else {
                        if (is_null($result)) {
                            $result = [];
                        }
                        $json = json_encode($this->getTemplates()[$template]);
                        $templateData = str_replace('"{template}"', json_encode($result), $json);
                        $templateData = json_decode($templateData, true);
                    }
                    $responses['default'] = $this->parseData($templateData, 'default');
                    break;
                }
                $apiSuccess = $method->getApiSuccess();
                $apiFail = $method->getApiFail();
                $emptyResponse = empty($responses);
                if ($emptyResponse) {
                    if (!empty($apiSuccess) && !$emptyResponse) {
                        $emptyResponse = false;
                        $defaultApiSuccess = array_shift($apiSuccess);
                        $defaultApiSuccessResponse = json_decode($this->parseDescTagContent($defaultApiSuccess), true);
                        $responses['default'] = $this->parseData($defaultApiSuccessResponse, 'default');
                    }

                    if (!empty($apiFail) && !$emptyResponse) {
                        $emptyResponse = false;
                        $defaultApiFail = array_shift($apiFail);
                        $defaultApiFailResponse = json_decode($this->parseDescTagContent($defaultApiFail), true);
                        $responses['default'] = $this->parseData($defaultApiFailResponse, 'default');
                    }
                }

                foreach ($apiSuccess as $successKey => $success) {
                    $success = json_decode($this->parseDescTagContent($success), true);
                    $successIndex = 'x-Success-' . $successKey;
                    $responses[$successIndex] = $this->parseData($success, $successIndex);
                }

                foreach ($apiFail as $failKey => $fail) {
                    $fail = json_decode($this->parseDescTagContent($fail), true);
                    $failIndex = 'x-Fail-' . $failKey;
                    $responses[$failIndex] = $this->parseData($fail, $failIndex);;
                }

                if ($emptyResponse) {
                    $contents = [];
                    foreach ($this->getAccepts() as $accept) {
                        $contents[$accept] = [];
                    }
                    $responses['default'] = [
                        'description' => 'default',
                        'content'     => $contents,
                    ];
                }

                //兼容api指定
                if ($method->getApiDescriptionTag()) {
                    $description = $this->parseDescTagContent($method->getApiDescriptionTag());
                } else {
                    if (!empty($apiTag->description)) {
                        trigger_error('@Api tag description property is deprecated,use @ApiDescription tag instead', E_USER_DEPRECATED);
                        $description = $apiTag->description;
                    } else {
                        $description = '';
                    }
                }

                $authParams = $this->checkSecurities($method->getApiAuth());
                $security = $this->getSecurities($globalAuth, $groupAuth, $authParams, $methodName);

                $pathOptions = [
                    'tags'        => $tags,
                    'summary'     => $apiTag->name,
                    'description' => $description,
                    'parameters'  => $parameters,
                    'responses'   => $responses,
                    'deprecated'  => $apiTag->deprecated,
                    'security'    => [],
                ];
                if (!empty($security)) {
                    $pathOptions['security'] = [$security];
                }
                $pathOptionsBack = $pathOptions;

                $path = [];
                $allows = $methods ? $methods->allow : ['get', 'post', 'delete', 'put', 'patch', 'options', 'head', 'track'];
                foreach ($allows as $allow) {
                    $pathOptions = $pathOptionsBack;
                    $allow = strtolower($allow);
                    if (in_array($allow, ['get', 'delete'])) {
                        foreach ($methodParamTags as $paramKey => $paramTag) {
                            $pathOptions['parameters'][] = $this->parseParamTag($paramTag, 'query');
                        }
                    } else {
                        $pathOptions['requestBody'] = $this->parseParamBody($methodParamTags);
                    }
                    $pathOptions['operationId'] = 'easyswoole' . md5($apiTag->path . $allow);
                    $path[$allow] = $pathOptions;
                }
                $data[] = $this->swaggerParser->path($path, $apiTag->path);
            }
        }
        return $data;
    }
}