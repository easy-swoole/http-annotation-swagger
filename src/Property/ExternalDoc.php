<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

/**
 * 外部文件
 *
 * @link Swagger
 * @link Tag
 */
class ExternalDoc extends BaseProperty
{
    /**
     * 描述
     * @var string $description
     */
    protected $description;

    /**
     * set
     * @var string $set
     */
    protected $url;

    public function setUrl(string $set): self
    {
        $this->url = $set;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
