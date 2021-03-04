<?php

namespace App\Swagger\Property;

class ServerVariable extends BaseProperty
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $default;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string[]|null
     */
    protected $enum;

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
     * @return ServerVariable
     */
    public function setKey(string $key): ServerVariable
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefault(): string
    {
        return $this->default;
    }

    /**
     * @param string $default
     *
     * @return ServerVariable
     */
    public function setDefault(string $default): ServerVariable
    {
        $this->default = $default;
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
     * @return ServerVariable
     */
    public function setDescription(?string $description): ServerVariable
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getEnum(): ?array
    {
        return $this->enum;
    }

    /**
     * @param string[]|null $enum
     *
     * @return ServerVariable
     */
    public function setEnum(?array $enum): ServerVariable
    {
        $this->enum = $enum;
        return $this;
    }
}
