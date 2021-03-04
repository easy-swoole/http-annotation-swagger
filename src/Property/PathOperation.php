<?php

namespace App\Swagger\Property;

class PathOperation extends BaseProperty
{
    /**
     * @var array|null
     */
    protected $tags;

    /**
     * @var string|null
     */
    protected $summary;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var ExternalDoc|null
     */
    protected $externalDocs;

    /**
     * @var string
     */
    protected $operationId;

    /**
     * @var PathParameter[]|null
     */
    protected $parameters;

    /**
     * @var PathRequestBody|null
     */
    protected $requestBody;

    /**
     * @var PathResponse[]|null
     */
    protected $responses;

    /**
     * @var bool|null
     */
    protected $deprecated;

    /**
     * @var array|null
     */
    protected $security;

    /**
     * @var Server[]|null
     */
    protected $servers;

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     *
     * @return PathOperation
     */
    public function setTags(?array $tags): PathOperation
    {
        $this->tags = $tags;
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
     * @return PathOperation
     */
    public function setSummary(?string $summary): PathOperation
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
     * @return PathOperation
     */
    public function setDescription(?string $description): PathOperation
    {
        $this->description = $description;
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
     * @return PathOperation
     */
    public function setExternalDocs(?ExternalDoc $externalDocs): PathOperation
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperationId(): string
    {
        return $this->operationId;
    }

    /**
     * @param string $operationId
     *
     * @return PathOperation
     */
    public function setOperationId(string $operationId): PathOperation
    {
        $this->operationId = $operationId;
        return $this;
    }

    /**
     * @return PathRequestBody|null
     */
    public function getRequestBody(): ?PathRequestBody
    {
        return $this->requestBody;
    }

    /**
     * @param PathRequestBody|null $requestBody
     *
     * @return PathOperation
     */
    public function setRequestBody(?PathRequestBody $requestBody): PathOperation
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDeprecated(): ?bool
    {
        return $this->deprecated;
    }

    /**
     * @param bool|null $deprecated
     *
     * @return PathOperation
     */
    public function setDeprecated(?bool $deprecated): PathOperation
    {
        $this->deprecated = $deprecated;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getSecurity(): ?array
    {
        return $this->security;
    }

    /**
     * @param array|null $security
     *
     * @return PathOperation
     */
    public function setSecurity(?array $security): PathOperation
    {
        $this->security = $security;
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
     * @return PathOperation
     */
    public function setServers(?array $servers): PathOperation
    {
        $this->servers = $servers;
        return $this;
    }

    /**
     * @return PathResponse[]|null
     */
    public function getResponses(): ?array
    {
        return $this->responses;
    }

    /**
     * @param PathResponse[]|null $responses
     *
     * @return PathOperation
     */
    public function setResponses(?array $responses): PathOperation
    {
        $this->responses = $responses;
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
     * @return PathOperation
     */
    public function setParameters(?array $parameters): PathOperation
    {
        $this->parameters = $parameters;
        return $this;
    }
}
