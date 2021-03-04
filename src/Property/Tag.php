<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

/**
 * 分类 ， 分组
 */
class Tag extends BaseProperty
{
    /**
     * 名称
     * @var string $name
     */
    protected $name;

    /**
     * 描述
     * @var string $description
     */
    protected $description;

    /**
     * 外部文件
     * externalDocs
     * @var ExternalDoc $externalDocs ;
     * @link ExternalDocs
     */
    protected $externalDocs;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setExternalDoc(?ExternalDoc $externalDoc): self
    {
        $this->externalDocs = $externalDoc;
        return $this;
    }

    public function getExternalDoc(): ExternalDoc
    {
        return $this->externalDocs;
    }
}
