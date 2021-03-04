<?php

namespace App\Swagger\Property;

class PathParameter extends BaseProperty
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $in;

    /**
     * @var string[]
     */
    private $allowIn = [
        'query',
        'header',
        'path',
        'cookie',
    ];

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var bool|null
     */
    protected $required;

    /**
     * @var bool|null
     */
    protected $deprecated;

    /**
     * @var bool|null
     */
    protected $allowEmptyValue;

    /**
     * @var string|null
     */
    protected $style;

    /**
     * @var array
     */
    private $allowStyle = [
        'query'  => [
            'allow'   => [
                'form',
                'spaceDelimited',
                'pipeDelimited',
                'deepObject',
            ],
            'default' => 'form',
        ],
        'header' => [
            'allow'   => [
                'simple',
            ],
            'default' => 'simple',
        ],
        'path'   => [
            'allow'   => [
                'simple',
                'matrix',
                'matrix',
                '',
            ],
            'default' => 'simple',
        ],
        'cookie' => [
            'allow'   => [
                'form',
            ],
            'default' => 'form',
        ],
    ];

    /**
     * @var bool|null
     */
    protected $explode;

    /**
     * @var bool|null
     */
    protected $allowReserved;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return PathParameter
     */
    public function setName(string $name): PathParameter
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIn(): string
    {
        return $this->in;
    }

    /**
     * @param string $in
     *
     * @return PathParameter
     */
    public function setIn(string $in): PathParameter
    {
        $this->in = $in;
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
     * @return PathParameter
     */
    public function setDescription(?string $description): PathParameter
    {
        $this->description = $description;
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
     * @return PathParameter
     */
    public function setRequired(?bool $required): PathParameter
    {
        $this->required = $required;
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
     * @return PathParameter
     */
    public function setDeprecated(?bool $deprecated): PathParameter
    {
        $this->deprecated = $deprecated;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowEmptyValue(): ?bool
    {
        return $this->allowEmptyValue;
    }

    /**
     * @param bool|null $allowEmptyValue
     *
     * @return PathParameter
     */
    public function setAllowEmptyValue(?bool $allowEmptyValue): PathParameter
    {
        $this->allowEmptyValue = $allowEmptyValue;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStyle(): ?string
    {
        return $this->style;
    }

    /**
     * @param string|null $style
     *
     * @return PathParameter
     */
    public function setStyle(?string $style): PathParameter
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExplode(): ?bool
    {
        return $this->explode;
    }

    /**
     * @param bool|null $explode
     *
     * @return PathParameter
     */
    public function setExplode(?bool $explode): PathParameter
    {
        $this->explode = $explode;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowReserved(): ?bool
    {
        return $this->allowReserved;
    }

    /**
     * @param bool|null $allowReserved
     *
     * @return PathParameter
     */
    public function setAllowReserved(?bool $allowReserved): PathParameter
    {
        $this->allowReserved = $allowReserved;
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
     * @return PathParameter
     */
    public function setSchema(ComponentSchema $schema): PathParameter
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
     * @return PathParameter
     */
    public function setExample(?Example $example): PathParameter
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
     * @return PathParameter
     */
    public function setExamples(?array $examples): PathParameter
    {
        $this->examples = $examples;
        return $this;
    }

    public function generate(): array
    {
        if (!in_array($this->getIn(), $this->allowIn)) {
            throw new \Exception("params in [{$this->getIn()}] error" . 'in only support ' . implode(',', $this->allowIn));
        }

        $allowStyle = !empty($this->allowStyle[$this->getIn()]) ? $this->allowStyle[$this->getIn()] : [];
        if (empty($this->getStyle())) {
            $this->setStyle($allowStyle['default']);
        }

        if (!in_array($this->getStyle(), $allowStyle['allow'])) {
            throw new \Exception("params style [{$this->getStyle()}] error" . 'style only support ' . implode(',', $allowStyle['allow']));
        }

        return parent::generate();
    }
}
