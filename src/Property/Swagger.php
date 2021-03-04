<?php

namespace App\Swagger\Property;

/**
 * Swagger Class
 *
 * @document https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md
 *
 */
class Swagger extends BaseProperty
{
    private const SWAGGER_VERSION = '3.0.2';

    /**
     * swagger version
     *
     * @var string openapi
     */
    protected $openapi;

    /**
     * @var Info $info
     */
    protected $info;

    /**
     *
     * @var Server[]|null
     */
    protected $servers;

    /**
     * @var Tag[]|null
     */
    protected $tags;

    /**
     * @var Component|null
     */
    protected $components;

    /**
     * @var ExternalDoc|null
     */
    protected $externalDocs;

    /**
     * @var array
     */
    protected $paths = [];

    /**
     * @return string
     */
    public function getOpenapi(): string
    {
        return $this->openapi;
    }

    /**
     * @param string|null $openapi
     *
     * @return Swagger
     */
    public function setOpenapi(?string $openapi): Swagger
    {
        if (empty($openapi)) {
            $openapi = self::SWAGGER_VERSION;
        }
        $this->openapi = $openapi;
        return $this;
    }

    /**
     * @return Info
     */
    public function getInfo(): Info
    {
        return $this->info;
    }

    /**
     * @param Info $info
     *
     * @return Swagger
     */
    public function setInfo(Info $info): Swagger
    {
        $this->info = $info;
        return $this;
    }

    /**
     * @return Server[]|null
     */
    public function getServers(): ?array
    {
        return $this->servers;
    }

    /**
     * @param Server[]|null $servers
     *
     * @return Swagger
     */
    public function setServers(?array $servers): Swagger
    {
        $this->servers = $servers;
        return $this;
    }

    /**
     * @return Tag[]|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param Tag[]|null $tags
     *
     * @return Swagger
     */
    public function setTags(?array $tags): Swagger
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return ExternalDoc|null
     */
    public function getExternalDocs(): ?ExternalDoc
    {
        return $this->externalDocs;
    }

    /**
     * @param ExternalDoc|null $externalDocs
     *
     * @return Swagger
     */
    public function setExternalDocs(?ExternalDoc $externalDocs): Swagger
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }

    /**
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    /**
     * @param array $paths
     *
     * @return Swagger
     */
    public function setPaths(array $paths): Swagger
    {
        $this->paths = $paths;
        return $this;
    }

    /**
     * @return Component|null
     */
    public function getComponents(): ?Component
    {
        return $this->components;
    }

    /**
     * @param Component|null $components
     *
     * @return Swagger
     */
    public function setComponents(?Component $components): Swagger
    {
        $this->components = $components;
        return $this;
    }

    /**
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag(Tag $tag): Swagger
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function generate(): array
    {
        $params = $this->getAttributes();
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $data = [];
                foreach ($value as $k => $v) {
                    $item = $v instanceof BaseProperty ? $v->generate() : $v;
                    if (isset($item['key'])) {
                        $k = $item['key'] ?? $k;
                        unset($item['key']);
                    }
                    $data[$k] = $item;
                }
                $params[$key] = $data;

            }
            if ($value instanceof BaseProperty) {
                $params[$key] = $value->generate();;
            }
            if ($key === 'paths' && empty($params[$key])) {
                $params[$key] = new \stdClass();
            }
            if (empty($params[$key])) {
                unset($params[$key]);
            }
        }
        return $params;
    }
}
