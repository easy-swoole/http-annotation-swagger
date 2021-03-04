<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

/**
 * 基础信息
 *
 * @link Swagger
 */
class Info extends BaseProperty
{
    /**
     * 描述
     * @var string|null $description
     */
    protected $description = '';

    /**
     * 接口文档版本号
     * @var string $version
     */
    protected $version;

    /**
     * 标题
     * @var string $title
     */
    protected $title;

    /**
     * 服务条款
     *
     * @var string|null $termsOfService
     */
    protected $termsOfService = '';

    /**
     * 联系
     * @var InfoContact|null
     */
    protected $contact;

    /**
     * 执照
     * @var InfoLicense|null
     */
    protected $license;

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
     * @return Info
     */
    public function setDescription(?string $description): Info
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Info
     */
    public function setVersion(string $version): Info
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Info
     */
    public function setTitle(string $title): Info
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTermsOfService(): ?string
    {
        return $this->termsOfService;
    }

    /**
     * @param string|null $termsOfService
     *
     * @return Info
     */
    public function setTermsOfService(?string $termsOfService): Info
    {
        $this->termsOfService = $termsOfService;
        return $this;
    }

    /**
     * @return InfoContact|null
     */
    public function getContact(): ?InfoContact
    {
        return $this->contact;
    }

    /**
     * @param InfoContact|null $contact
     *
     * @return Info
     */
    public function setContact(?InfoContact $contact): Info
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return InfoLicense|null
     */
    public function getLicense(): ?InfoLicense
    {
        return $this->license;
    }

    /**
     * @param InfoLicense|null $license
     *
     * @return Info
     */
    public function setLicense(?InfoLicense $license): Info
    {
        $this->license = $license;
        return $this;
    }
}
