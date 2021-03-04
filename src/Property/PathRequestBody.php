<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

class PathRequestBody extends BaseProperty
{
    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var bool|null
     */
    protected $required;

    /**
     * @var PathRequestBodyContent[]
     */
    protected $content;

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
     * @return PathRequestBody
     */
    public function setDescription(?string $description): PathRequestBody
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
     * @return PathRequestBody
     */
    public function setRequired(?bool $required): PathRequestBody
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return PathRequestBodyContent[]
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param PathRequestBodyContent[] $content
     *
     * @return PathRequestBody
     */
    public function setContent(array $content): PathRequestBody
    {
        $this->content = $content;
        return $this;
    }
}
