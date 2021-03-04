<?php

namespace App\Swagger;

use App\Swagger\Property\Component;
use App\Swagger\Property\Info;
use App\Swagger\Property\InfoContact;
use App\Swagger\Property\InfoLicense;
use App\Swagger\Property\Path;
use App\Swagger\Property\Swagger;
use App\Swagger\Property\Tag;
use EasySwoole\Spl\SplArray;
use Exception;

/**
 * Class GenerateSwagger
 * @package App\Swagger
 */
class GenerateSwagger
{
    /**
     * @var SplArray
     */
    protected $config;

    /**
     * @var Swagger
     */
    protected $swagger;

    /**
     * @var AnnotationParserInterface
     */
    protected $annotationParser;

    /**
     * @var SwaggerParser
     */
    protected $swaggerParser;

    /**
     * GenerateSwagger constructor.
     *
     * @param SplArray                  $config
     * @param AnnotationParserInterface $annotationParser
     */
    public function __construct(SplArray $config, AnnotationParserInterface $annotationParser)
    {
        $this->config = $config;
        $this->swagger = new Swagger();
        $this->swaggerParser = new SwaggerParser();
        $this->annotationParser = $annotationParser;
        $this->annotationParser->setAccepts($config->get('accepts') ?? []);
        $this->annotationParser->setTemplates($config->get('templates') ?? []);
        $this->annotationParser->setContentTypes($config->get('contentTypes') ?? []);
    }

    /**
     * @return InfoContact|null
     */
    protected function getContact(): ?InfoContact
    {
        if (!$this->config->get('info.contact')) {
            return null;
        }
        return (new InfoContact())->setEmail($this->config->get('info.contact.email'))
            ->setName($this->config->get('info.contact.name'))
            ->setUrl($this->config->get('info.contact.url'));
    }

    /**
     * @return InfoLicense|null
     */
    protected function getLicense(): ?InfoLicense
    {
        if (!$this->config->get('info.license')) {
            return null;
        }
        return (new InfoLicense())->setName($this->config->get('info.license.name'))->setUrl($this->config->get('info.license.url'));
    }

    /**
     * @return Info
     */
    protected function getInfo(): Info
    {
        return (new Info())->setTitle($this->config->get('info.title'))
            ->setVersion($this->config->get('info.version'))
            ->setDescription($this->config->get('info.description'))
            ->setTermsOfService($this->config->get('info.termsOfService'))
            ->setContact($this->getContact())
            ->setLicense($this->getLicense());
    }

    /**
     * @return Tag[]
     */
    protected function getTags(): array
    {
        $data = [];
        $tags = $this->config->get('tags') ?? [];
        foreach ($tags as $tag) {
            $tagParams = new SplArray($tag);
            $tagProperty = new Tag();
            $data[] = $tagProperty->setName($tagParams->get('name'))
                ->setDescription($tagParams->get('description'))
                ->setExternalDoc($this->swaggerParser->externalDoc($tagParams->get('externalDoc')));
        }
        return $data;
    }

    protected function getServers(): ?array
    {
        $serverLists = $this->config->get('servers');
        if (!$serverLists) {
            return null;
        }
        $data = [];
        foreach ($serverLists as $serverList) {
            $data[] = $this->swaggerParser->server($serverList);
        }
        return $data;
    }

    protected function getComponents(): ?Component
    {
        $component = new Component();
        if ($this->config->get('component.schemas')) {
            $schemas = [];
            foreach ($this->config->get('component.schemas') as $key => $schema) {
                $schemas[] = $this->swaggerParser->schema($schema, $key);
            }
            $component->setSchemas($schemas);
        }

        if ($this->config->get('component.responses')) {
            $responses = [];
            foreach ($this->config->get('component.responses') as $key => $response) {
                $responses[] = $this->swaggerParser->response($response, $key);
            }
            $component->setResponses($responses);
        }

        if ($this->config->get('component.parameters')) {
            $parameters = [];
            foreach ($this->config->get('component.parameters') as $parameter) {
                $parameters[] = $this->swaggerParser->parameter($parameter);
            }
            $component->setParameters($parameters);
        }

        if ($this->config->get('component.examples')) {
            $examples = [];
            foreach ($this->config->get('component.examples') as $example) {
                $examples[] = $this->swaggerParser->example($example);
            }
            $component->setExamples($examples);
        }

        if ($this->config->get('component.requestBodies')) {
            $requestBodies = [];
            foreach ($this->config->get('component.requestBodies') as $requestBody) {
                $requestBodies[] = $this->swaggerParser->requestBody($requestBody);
            }
            $component->setRequestBodies($requestBodies);
        }

        if ($this->config->get('component.securitySchemes')) {
            $securitySchemes = [];
            foreach ($this->config->get('component.securitySchemes') as $key => $securityScheme) {
                if (is_int($key)) {
                    $key = null;
                }
                $securitySchemes[] = $this->swaggerParser->securityScheme($securityScheme, $key);
            }
            $component->setSecuritySchemes($securitySchemes);
        }
        return $component;
    }

    /**
     * @return Path[]
     */
    protected function getPaths(): array
    {
        $this->annotationParser->setSwagger($this->swagger);
        return $this->annotationParser->parser();
    }

    /**
     * @return array
     * @throws Exception
     */
    public function scan2Json(): array
    {
        return $this->swagger->setOpenapi($this->config->get('openapi'))
            ->setInfo($this->getInfo())
            ->setTags($this->getTags())
            ->setServers($this->getServers())
            ->setComponents($this->getComponents())
            ->setExternalDocs($this->swaggerParser->externalDoc($this->config->get('externalDoc') ?? []))
            ->setPaths($this->getPaths())
            ->generate();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function scan2Html(): string
    {
        $json = $this->scan2Json();
        $html = file_get_contents(__DIR__ . '/Html/swagger.html');
        return str_replace("{%template%}", json_encode($json), $html);
    }
}
