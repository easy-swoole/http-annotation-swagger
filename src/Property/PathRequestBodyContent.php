<?php

namespace App\Swagger\Property;

class PathRequestBodyContent extends BaseProperty
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var ComponentSchema
     */
    protected $schema;

    /**
     * @var Example|null
     */
    protected $example;

    /**
     * @var Example[]|null
     */
    protected $examples;

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
     * @return PathRequestBodyContent
     */
    public function setKey(string $key): PathRequestBodyContent
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return ComponentSchema
     */
    public function getSchema(): ComponentSchema
    {
        return $this->schema;
    }

    /**
     * @param ComponentSchema $schema
     *
     * @return PathRequestBodyContent
     */
    public function setSchema(ComponentSchema $schema): PathRequestBodyContent
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * @return Example|null
     */
    public function getExample(): ?Example
    {
        return $this->example;
    }

    /**
     * @param Example|null $example
     *
     * @return PathRequestBodyContent
     */
    public function setExample(?Example $example): PathRequestBodyContent
    {
        $this->example = $example;
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
     * @return PathRequestBodyContent
     */
    public function setExamples(?array $examples): PathRequestBodyContent
    {
        $this->examples = $examples;
        return $this;
    }
}
