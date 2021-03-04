<?php

namespace App\Swagger\Property;

class Example extends BaseProperty
{
    /**
     * @var string|null
     */
    protected $summary;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string|null
     */
    protected $externalValue;

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
     * @return Example
     */
    public function setSummary(?string $summary): Example
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
     * @return Example
     */
    public function setDescription(?string $description): Example
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return Example
     */
    public function setValue($value): Example
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalValue(): ?string
    {
        return $this->externalValue;
    }

    /**
     * @param string|null $externalValue
     *
     * @return Example
     */
    public function setExternalValue(?string $externalValue): Example
    {
        $this->externalValue = $externalValue;
        return $this;
    }
}
