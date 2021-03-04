<?php

namespace App\Swagger\Property;

/**
 * @document  http://json-schema.org/
 * @document https://www.jianshu.com/p/1711f2f24dcf?utm_campaign=hugo
 */
class ComponentSchemaProperty extends BaseProperty
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
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
     * 将使用此架构提供一个标题，title一般用来进行简单的描述，可以省略
     * @var string|null
     */
    protected $title;

    /**
     * 数值实例有效反对“multipleOf”分工的实例此关键字的值，如果结果是一个整数
     * @var float|int|null
     */
    protected $multipleOf;

    /**
     * 这是约束的值被提上表示可接受的最大值
     * @var float|int|null
     */
    protected $maximum;

    /**
     * 如果“exclusiveMaximum”的存在，并且具有布尔值true的实例是有效的，如果它是严格的值小于“最大”。
     * @var bool|null
     */
    protected $exclusiveMaximum;

    /**
     * 这是约束的值，并代表可接受的最小值
     * @var float|int|null
     */
    protected $minimum;

    /**
     * 如果“exclusiveMinimum”的存在，并且具有布尔值true的实例是有效的，如果它是严格的最低限度的值
     * @var bool|null
     */
    protected $exclusiveMinimum;

    /**
     * 字符串实例的长度被定义为字符的最大数目
     * @var int|null
     */
    protected $maxLength;

    /**
     * 字符串实例的长度被定义为字符的最小数目
     * @var int|null
     */
    protected $minLength;

    /**
     * String实例被认为是有效的，如果正则表达式匹配成功实例
     * @var string|null
     */
    protected $pattern;

    /**
     * 约束属性，数组最大的元素个数
     * @var int|null
     */
    protected $maxItems;

    /**
     * @var int|null
     */
    protected $minItems;

    /**
     * @var bool|null
     */
    protected $uniqueItems;

    /**
     * @var int|null
     */
    protected $maxProperties;

    /**
     * @var int|null
     */
    protected $minProperties;

    /**
     * @var bool|null
     */
    protected $required;

    /**
     * @var array|null
     */
    protected $enum;

    /**
     * @var mixed|null
     */
    protected $default;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var bool|null
     */
    protected $deprecated;

    /**
     * @var mixed|null
     */
    protected $example;

    /**
     * @var string|null
     */
    protected $ref;

    /**
     * @var array|null
     */
    protected $xml;

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
     * @return ComponentSchemaProperty
     */
    public function setKey(string $key): ComponentSchemaProperty
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return ComponentSchemaProperty
     */
    public function setType(string $type): ComponentSchemaProperty
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return ComponentSchemaProperty
     */
    public function setTitle(?string $title): ComponentSchemaProperty
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getMultipleOf()
    {
        return $this->multipleOf;
    }

    /**
     * @param float|int|null $multipleOf
     *
     * @return ComponentSchemaProperty
     */
    public function setMultipleOf($multipleOf)
    {
        $this->multipleOf = $multipleOf;
        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * @param float|int|null $maximum
     *
     * @return ComponentSchemaProperty
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExclusiveMaximum(): ?bool
    {
        return $this->exclusiveMaximum;
    }

    /**
     * @param bool|null $exclusiveMaximum
     *
     * @return ComponentSchemaProperty
     */
    public function setExclusiveMaximum(?bool $exclusiveMaximum): ComponentSchemaProperty
    {
        $this->exclusiveMaximum = $exclusiveMaximum;
        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @param float|int|null $minimum
     *
     * @return ComponentSchemaProperty
     */
    public function setMinimum($minimum): ComponentSchemaProperty
    {
        $this->minimum = $minimum;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExclusiveMinimum(): ?bool
    {
        return $this->exclusiveMinimum;
    }

    /**
     * @param bool|null $exclusiveMinimum
     *
     * @return ComponentSchemaProperty
     */
    public function setExclusiveMinimum(?bool $exclusiveMinimum): ComponentSchemaProperty
    {
        $this->exclusiveMinimum = $exclusiveMinimum;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     * @param int|null $maxLength
     *
     * @return ComponentSchemaProperty
     */
    public function setMaxLength(?int $maxLength): ComponentSchemaProperty
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    /**
     * @param int|null $minLength
     *
     * @return ComponentSchemaProperty
     */
    public function setMinLength(?int $minLength): ComponentSchemaProperty
    {
        $this->minLength = $minLength;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    /**
     * @param string|null $pattern
     *
     * @return ComponentSchemaProperty
     */
    public function setPattern(?string $pattern): ComponentSchemaProperty
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    /**
     * @param int|null $maxItems
     *
     * @return ComponentSchemaProperty
     */
    public function setMaxItems(?int $maxItems): ComponentSchemaProperty
    {
        $this->maxItems = $maxItems;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinItems(): ?int
    {
        return $this->minItems;
    }

    /**
     * @param int|null $minItems
     *
     * @return ComponentSchemaProperty
     */
    public function setMinItems(?int $minItems): ComponentSchemaProperty
    {
        $this->minItems = $minItems;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUniqueItems(): ?bool
    {
        return $this->uniqueItems;
    }

    /**
     * @param bool|null $uniqueItems
     *
     * @return ComponentSchemaProperty
     */
    public function setUniqueItems(?bool $uniqueItems): ComponentSchemaProperty
    {
        $this->uniqueItems = $uniqueItems;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxProperties(): ?int
    {
        return $this->maxProperties;
    }

    /**
     * @param int|null $maxProperties
     *
     * @return ComponentSchemaProperty
     */
    public function setMaxProperties(?int $maxProperties): ComponentSchemaProperty
    {
        $this->maxProperties = $maxProperties;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinProperties(): ?int
    {
        return $this->minProperties;
    }

    /**
     * @param int|null $minProperties
     *
     * @return ComponentSchemaProperty
     */
    public function setMinProperties(?int $minProperties): ComponentSchemaProperty
    {
        $this->minProperties = $minProperties;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRequired(): ?bool
    {
        return $this->required;
    }

    /**
     * @param bool|null $required
     *
     * @return ComponentSchemaProperty
     */
    public function setRequired(?bool $required): ComponentSchemaProperty
    {
        $this->required = $required;
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
     *
     * @return ComponentSchemaProperty
     */
    public function setEnum(?array $enum): ComponentSchemaProperty
    {
        $this->enum = $enum;
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
     * @return ComponentSchemaProperty
     */
    public function setDefault($default)
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
     * @return ComponentSchemaProperty
     */
    public function setDescription(?string $description): ComponentSchemaProperty
    {
        $this->description = $description;
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
     * @return ComponentSchemaProperty
     */
    public function setDeprecated(?bool $deprecated): ComponentSchemaProperty
    {
        $this->deprecated = $deprecated;
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
     * @return ComponentSchemaProperty
     */
    public function setExample($example)
    {
        $this->example = $example;
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
     * @return ComponentSchemaProperty
     */
    public function setRef(?string $ref): ComponentSchemaProperty
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getXml(): ?array
    {
        return $this->xml;
    }

    /**
     * @param array|null $xml
     *
     * @return ComponentSchemaProperty
     */
    public function setXml(?array $xml): ComponentSchemaProperty
    {
        $this->xml = $xml;
        return $this;
    }

    public function generate(): array
    {
        if (!in_array($this->getType(), $this->allowType)) {
            throw new \Exception("params type [{$this->getKey()}] error".',only support ' . implode(',', $this->allowType));
        }
        return parent::generate();
    }

}
