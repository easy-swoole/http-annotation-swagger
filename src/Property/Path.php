<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

/**
 * 路由
 *
 * @link Swagger
 */
class Path extends BaseProperty
{
    /**
     * path
     * @var string
     */
    protected $key;

    /**
     * @var string|null
     */
    protected $ref;

    /**
     * @var string|null
     */
    protected $summary;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var Server[]|null
     */
    protected $servers;

    /**
     * @var PathParameter[]|null
     */
    protected $parameters;

    /**
     * @var PathOperation
     */
    protected $get;

    /**
     * @var PathOperation
     */
    protected $post;

    /**
     * @var PathOperation
     */
    protected $put;

    /**
     * @var PathOperation
     */
    protected $delete;

    /**
     * @var PathOperation
     */
    protected $options;

    /**
     * @var PathOperation
     */
    protected $head;

    /**
     * @var PathOperation
     */
    protected $patch;

    /**
     * @var PathOperation
     */
    protected $trace;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     *
     * @return Path
     */
    public function setKey(string $key): Path
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRef(): ?string
    {
        return $this->ref;
    }

    /**
     * @param string|null $ref
     *
     * @return Path
     */
    public function setRef(?string $ref): Path
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     *
     * @return Path
     */
    public function setSummary(?string $summary): Path
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return Path
     */
    public function setDescription(?string $description): Path
    {
        $this->description = $description;
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
     * @return Path
     */
    public function setServers(?array $servers): Path
    {
        $this->servers = $servers;
        return $this;
    }

    /**
     * @return PathParameter[]|null
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * @param PathParameter[]|null $parameters
     *
     * @return Path
     */
    public function setParameters(?array $parameters): Path
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getGet(): PathOperation
    {
        return $this->get;
    }

    /**
     * @param PathOperation $get
     *
     * @return Path
     */
    public function setGet(PathOperation $get): Path
    {
        $this->get = $get;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getPost(): PathOperation
    {
        return $this->post;
    }

    /**
     * @param PathOperation $post
     *
     * @return Path
     */
    public function setPost(PathOperation $post): Path
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getPut(): PathOperation
    {
        return $this->put;
    }

    /**
     * @param PathOperation $put
     *
     * @return Path
     */
    public function setPut(PathOperation $put): Path
    {
        $this->put = $put;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getDelete(): PathOperation
    {
        return $this->delete;
    }

    /**
     * @param PathOperation $delete
     *
     * @return Path
     */
    public function setDelete(PathOperation $delete): Path
    {
        $this->delete = $delete;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getOptions(): PathOperation
    {
        return $this->options;
    }

    /**
     * @param PathOperation $options
     *
     * @return Path
     */
    public function setOptions(PathOperation $options): Path
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getHead(): PathOperation
    {
        return $this->head;
    }

    /**
     * @param PathOperation $head
     *
     * @return Path
     */
    public function setHead(PathOperation $head): Path
    {
        $this->head = $head;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getPatch(): PathOperation
    {
        return $this->patch;
    }

    /**
     * @param PathOperation $patch
     *
     * @return Path
     */
    public function setPatch(PathOperation $patch): Path
    {
        $this->patch = $patch;
        return $this;
    }

    /**
     * @return PathOperation
     */
    public function getTrace(): PathOperation
    {
        return $this->trace;
    }

    /**
     * @param PathOperation $trace
     *
     * @return Path
     */
    public function setTrace(PathOperation $trace): Path
    {
        $this->trace = $trace;
        return $this;
    }
}
