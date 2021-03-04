<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

class Component extends BaseProperty
{
    /**
     * @var ComponentSchema[]
     */
    protected $schemas;

    /**
     * @var PathResponse[]|null
     */
    protected $responses;

    /**
     * @var PathParameter[]|null
     */
    protected $parameters;

    /**
     * @var Example[]|null
     */
    protected $examples;

    /**
     * @var PathRequestBody[]|null
     */
    protected $requestBodies;

    /**
     * @var Security[]|null
     */
    protected $securitySchemes;

    /**
     * @return ComponentSchema[]
     */
    public function getSchemas(): array
    {
        return $this->schemas;
    }

    /**
     * @param ComponentSchema[] $schemas
     *
     * @return Component
     */
    public function setSchemas(array $schemas): Component
    {
        $this->schemas = $schemas;
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
     * @return Component
     */
    public function setResponses(?array $responses): Component
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
     * @return Component
     */
    public function setParameters(?array $parameters): Component
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return Example[]|null
     */
    public function getExamples(): ?array
    {
        return $this->examples;
    }

    /**
     * @param Example[]|null $examples
     *
     * @return Component
     */
    public function setExamples(?array $examples): Component
    {
        $this->examples = $examples;
        return $this;
    }

    /**
     * @return PathRequestBody[]|null
     */
    public function getRequestBodies(): ?array
    {
        return $this->requestBodies;
    }

    /**
     * @param PathRequestBody[]|null $requestBodies
     *
     * @return Component
     */
    public function setRequestBodies(?array $requestBodies): Component
    {
        $this->requestBodies = $requestBodies;
        return $this;
    }

    /**
     * @return Security[]|null
     */
    public function getSecuritySchemes(): ?array
    {
        return $this->securitySchemes;
    }

    /**
     * @param Security[]|null $securitySchemes
     *
     * @return Component
     */
    public function setSecuritySchemes(?array $securitySchemes): Component
    {
        $this->securitySchemes = $securitySchemes;
        return $this;
    }

    /**
     * @param Security $security
     *
     * @return $this
     */
    public function addSecurityScheme(Security $security): Component
    {
        $this->securitySchemes[] = $security;
        return $this;
    }

}
