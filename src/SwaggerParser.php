<?php

namespace EasySwoole\HttpAnnotation\Swagger;

use EasySwoole\HttpAnnotation\Swagger\Property\ComponentSchema;
use EasySwoole\HttpAnnotation\Swagger\Property\ComponentSchemaProperty;
use EasySwoole\HttpAnnotation\Swagger\Property\Example;
use EasySwoole\HttpAnnotation\Swagger\Property\ExternalDoc;
use EasySwoole\HttpAnnotation\Swagger\Property\Path;
use EasySwoole\HttpAnnotation\Swagger\Property\PathOperation;
use EasySwoole\HttpAnnotation\Swagger\Property\PathParameter;
use EasySwoole\HttpAnnotation\Swagger\Property\PathRequestBody;
use EasySwoole\HttpAnnotation\Swagger\Property\PathRequestBodyContent;
use EasySwoole\HttpAnnotation\Swagger\Property\PathResponse;
use EasySwoole\HttpAnnotation\Swagger\Property\Security;
use EasySwoole\HttpAnnotation\Swagger\Property\SecurityFlow;
use EasySwoole\HttpAnnotation\Swagger\Property\Server;
use EasySwoole\HttpAnnotation\Swagger\Property\ServerVariable;
use EasySwoole\Spl\SplArray;

class SwaggerParser
{

    /**
     * @param array $params
     *
     * @return ComponentSchemaProperty[]|ComponentSchema
     */
    protected function schemaProperty(array $params)
    {
        if (isset($params['properties']) || isset($params['items'])) {
            return $this->schema($params);
        }

        $data = [];
        foreach ($params as $key => $item) {
            $schemaPropertyParams = new SplArray($item);
            if ($schemaPropertyParams->get('properties') || $schemaPropertyParams->get('items')) {
                $data[] = $this->schema($item, $key);
                continue;
            }

            $componentSchemaProperty = new ComponentSchemaProperty();
            $componentSchemaProperty->setKey($key)
                ->setType($schemaPropertyParams->get('type'))
                ->setTitle($schemaPropertyParams->get('title'))
                ->setMultipleOf($schemaPropertyParams->get('multipleOf'))
                ->setMaximum($schemaPropertyParams->get('maximum'))
                ->setExclusiveMaximum($schemaPropertyParams->get('exclusiveMaximum'))
                ->setMinimum($schemaPropertyParams->get('minimum'))
                ->setExclusiveMinimum($schemaPropertyParams->get('exclusiveMinimum'))
                ->setMaxLength($schemaPropertyParams->get('maxLength'))
                ->setMinLength($schemaPropertyParams->get('minLength'))
                ->setPattern($schemaPropertyParams->get('pattern'))
                ->setMaxItems($schemaPropertyParams->get('maxItems'))
                ->setMinItems($schemaPropertyParams->get('minItems'))
                ->setUniqueItems($schemaPropertyParams->get('uniqueItems'))
                ->setMaxProperties($schemaPropertyParams->get('maxProperties'))
                ->setMinProperties($schemaPropertyParams->get('minProperties'))
                ->setRequired($schemaPropertyParams->get('required'))
                ->setEnum($schemaPropertyParams->get('enum'))
                ->setDefault($schemaPropertyParams->get('default'))
                ->setDescription($schemaPropertyParams->get('description'))
                ->setDeprecated($schemaPropertyParams->get('deprecated'))
                ->setExample($schemaPropertyParams->get('example'))
                ->setRef($schemaPropertyParams->get('ref'))
                ->setXml($schemaPropertyParams->get('xml'));
            $data[] = $componentSchemaProperty;
        }
        return $data;
    }

    /**
     * @param array $params
     * @param string|null $key
     *
     * @return ComponentSchema
     */
    public function schema(array $params, ?string $key = null): ComponentSchema
    {
        $schema = new ComponentSchema();
        if (empty($params)) {
            return $schema;
        }
        $params = new SplArray($params);

        $properties = $this->schemaProperty($params->get('properties') ?? []);
        $items = $this->schemaProperty($params->get('items') ?? []);

        $schema->setKey($key)
            ->setType($params->get('type'))
            ->setProperties($properties)
            ->setRequired(is_array($params->get('required')) ? $params->get('required') : [])
            ->setItems($items)
            ->setDescription($params->get('description'))
            ->setFormat($params->get('format'))
            ->setDefault($params->get('default'))
            ->setExample($params->get('example'))
            ->setEnum($params->get('enum'))
            ->setDeprecated($params->get('deprecated'));
        return $schema;
    }

    /**
     * @param array $params
     * @param string $key
     *
     * @return PathRequestBodyContent
     */
    public function requestBodyContent(array $params, string $key): PathRequestBodyContent
    {
        $contentParams = new SplArray($params);
        $content = new PathRequestBodyContent();
        $examples = [];
        foreach ($contentParams->get('examples') ?? [] as $item) {
            $examples[] = $this->example($item);
        }

        $content->setKey($key)
            ->setExamples($examples)
            ->setExample($this->example($contentParams->get('example') ?? []))
            ->setSchema($this->schema($contentParams->get('schema') ?? []));
        return $content;
    }

    /**
     * @param array $params
     * @param string $key
     *
     * @return PathResponse
     */
    public function response(array $params, string $key): PathResponse
    {
        $params = new SplArray($params);
        $contents = [];
        foreach ($params->get('content') as $k => $item) {
            $contents[] = $this->requestBodyContent($item, $k);
        }
        $response = new PathResponse();
        $response->setKey($key)->setDescription($params->get('description'))->setContent($contents);
        return $response;
    }

    /**
     * @param array $params
     *
     * @return PathParameter
     */
    public function parameter(array $params): PathParameter
    {
        $params = new SplArray($params);
        $parameter = new PathParameter();
        $examples = [];
        foreach ($params->get('examples') ?? [] as $item) {
            $examples[] = $this->example($item);
        }
        $parameter->setName($params->get('name'))
            ->setRequired($params->get('required'))
            ->setIn($params->get('in'))
            ->setDescription($params->get('description'))
            ->setDeprecated($params->get('deprecated'))
            ->setAllowEmptyValue($params->get('allowEmptyValue'))
            ->setStyle($params->get('style'))
            ->setExplode($params->get('explode'))
            ->setAllowReserved($params->get('allowReserved'))
            ->setSchema($this->schema($params->get('schema')))
            ->setExample($this->example($params->get('example') ?? []))
            ->setExamples($examples);
        return $parameter;
    }

    /**
     * @param array $params
     *
     * @return Example
     */
    public function example(array $params): Example
    {
        $params = new SplArray($params);
        $example = new Example();
        $example->setSummary($params->get('summary'))
            ->setDescription($params->get('description'))
            ->setValue($params->get('value'))
            ->setExternalValue($params->get('externalValue'));
        return $example;
    }

    /**
     * @param array $params
     *
     * @return PathRequestBody
     */
    public function requestBody(array $params): PathRequestBody
    {
        $params = new SplArray($params);
        $requestBody = new PathRequestBody();
        $contents = [];
        foreach ($params->get('content') ?? [] as $k => $item) {
            $contents[] = $this->requestBodyContent($item, $k);
        }
        $requestBody->setContent($contents);
        return $requestBody;
    }

    /**
     * @param array $params
     * @param string $key
     *
     * @return Security
     */
    public function securityScheme(array $params, ?string $key = null): Security
    {
        $params = new SplArray($params);
        $securityScheme = new Security();
        if (is_null($key)) {
            $key = $params->get('name');
        }
        $flows = [];
        foreach ($params->get('flows') ?? [] as $name => $item) {
            $itemParams = new SplArray($item);
            $flow = new SecurityFlow();
            $flow->setKey($name)
                ->setAuthorizationUrl($itemParams->get('authorizationUrl'))
                ->setRefreshUrl($itemParams->get('refreshUrl'))
                ->setScopes($itemParams->get('scopes'))
                ->setTokenUrl($itemParams->get('tokenUrl'));
            $flows[] = $flow;
        }

        $securityScheme->setKey($key)
            ->setType($params->get('type'))
            ->setName($params->get('name'))
            ->setIn($params->get('in'))
            ->setScheme($params->get('scheme'))
            ->setDescription($params->get('description'))
            ->setFlows($flows)
            ->setBearerFormat($params->get('bearerFormat'))
            ->setOpenIdConnectUrl($params->get('openIdConnectUrl'));
        return $securityScheme;
    }

    /**
     * @param array $params
     *
     * @return ExternalDoc|null
     */
    public function externalDoc(array $params): ?ExternalDoc
    {
        if (empty($params)) {
            return null;
        }
        $params = new SplArray($params);
        return (new ExternalDoc())->setUrl($params->get('url'))->setDescription($params->get('description'));
    }

    /**
     * @param array $params
     *
     * @return Server
     */
    public function server(array $params): Server
    {
        $serverParams = new SplArray($params);
        $variableList = [];
        foreach ($serverParams->get('variables') as $key => $variable) {
            $variableParams = new SplArray($variable);
            $serverVariable = (new ServerVariable())->setKey($key)
                ->setDefault($variableParams->get('default'))
                ->setDescription($variableParams->get('description'))
                ->setEnum($variableParams->get('enum'));
            $variableList[] = $serverVariable;
        }
        return (new Server())->setDescription($serverParams->get('description'))->setUrl($serverParams->get('url'))->setVariables($variableList);
    }

    /**
     * @param array $params
     *
     * @return PathOperation
     */
    public function pathOperation(array $params): PathOperation
    {
        $params = new SplArray($params);
        $pathOperation = new PathOperation();

        $responses = [];
        foreach ($params->get('responses') ?? [] as $key => $response) {
            $responses[] = $this->response($response, $key);
        }

        $servers = [];
        foreach ($params->get('servers') ?? [] as $server) {
            $servers[] = $this->server($server);
        }

        $parameters = [];
        foreach ($params->get('parameters') ?? [] as $key => $parameter) {
            $parameters[] = $this->parameter($parameter);
        }

        $pathOperation->setTags($params->get('tags'))
            ->setSummary($params->get('summary'))
            ->setDescription($params->get('description'))
            ->setExternalDocs($this->externalDoc($params->get('externalDoc') ?? []))
            ->setOperationId($params->get('operationId'))
            ->setRequestBody($this->requestBody($params->get('requestBody') ?? []))
            ->setParameters($parameters)
            ->setResponses($responses)
            ->setDeprecated($params->get('deprecated'))
            ->setSecurity($params->get('security'))
            ->setServers($servers);
        return $pathOperation;
    }

    /**
     * @param array $params
     * @param string $key
     *
     * @return Path
     */
    public function path(array $params, string $key): Path
    {
        $pathParams = new SplArray($params);
        $servers = [];
        foreach ($pathParams->get('servers') ?? [] as $server) {
            $servers[] = $this->server($server);
        }
        $parameters = [];
        foreach ($pathParams->get('parameters') ?? [] as $parameter) {
            $parameters[] = $this->parameter($parameter);
        }
        $path = new Path();
        $path->setKey($key)
            ->setRef($pathParams->get('ref'))
            ->setSummary($pathParams->get('summary'))
            ->setDescription($pathParams->get('description'))
            ->setServers($servers)
            ->setParameters($parameters);
        $methods = [
            'get',
            'post',
            'put',
            'delete',
            'options',
            'head',
            'patch',
            'trace',
        ];
        foreach ($methods as $method) {
            if ($pathParams->get($method)) {
                $methodParams = $pathParams->get($method);
                if ($method === 'get') {
                    $methodParams['requestBody'] = null;
                }
                $fun = 'set' . ucfirst($method);
                $path->$fun($this->pathOperation($methodParams));
            }
        }
        return $path;
    }
}
