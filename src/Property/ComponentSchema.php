<?php

namespace App\Swagger\Property;

class ComponentSchema extends BaseProperty
{
    /**
     * @var string|null
     */
    protected $key;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var string[]
     */
    private $allowType = [
        'array',
        'boolean',
        'integer',
        'number',
        'object',
        'string',
    ];

    /**
     * @var ComponentSchemaProperty[]|null
     */
    protected $properties;

    /**
     * @var string[]|null
     */
    protected $required;

    /**
     * @var ComponentSchemaProperty|ComponentSchemaProperty[]|null
     */
    protected $items;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string|null
     */
    protected $format;

    /**
     * @var mixed|null
     */
    protected $default;

    /**
     * @var mixed|null
     */
    protected $example;

    /**
     * @var bool|null
     */
    protected $deprecated;

    /**
     * @var array|null
     */
    protected $enum;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return z
     */
    public function setType(?string $type): ComponentSchema
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return ComponentSchemaProperty[]|null
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * @param ComponentSchemaProperty[]|null $properties
     *
     * @return ComponentSchema
     */
    public function setProperties(?array $properties): ComponentSchema
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getRequired(): ?array
    {
        return $this->required;
    }

    /**
     * @param string[]|null $required
     *
     * @return ComponentSchema
     */
    public function setRequired(?array $required): ComponentSchema
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return ComponentSchemaProperty|ComponentSchemaProperty[]|null
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ComponentSchemaProperty|ComponentSchemaProperty[]|null $items
     *
     * @return ComponentSchema
     */
    public function setItems($items)
    {
        $this->items = $items;
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
     * @return ComponentSchema
     */
    public function setDescription(?string $description): ComponentSchema
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string|null $format
     *
     * @return ComponentSchema
     */
    public function setFormat(?string $format): ComponentSchema
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed|null $default
     *
     * @return ComponentSchema
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param mixed|null $example
     *
     * @return ComponentSchema
     */
    public function setExample($example)
    {
        $this->example = $example;
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
     * @return ComponentSchema
     */
    public function setDeprecated(?bool $deprecated): ComponentSchema
    {
        $this->deprecated = $deprecated;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     *
     * @return ComponentSchema
     */
    public function setKey(?string $key): ComponentSchema
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getEnum(): ?array
    {
        return $this->enum;
    }

    /**
     * @param array|null $enum
     * @return ComponentSchema
     */
    public function setEnum(?array $enum): ComponentSchema
    {
        $this->enum = $enum;
        return $this;
    }
}
