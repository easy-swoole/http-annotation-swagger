<?php

namespace App\Swagger\Property;

/**
 * 基本信息 - 许可
 *
 * @link  Info
 */
class InfoLicense extends BaseProperty
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $url;

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
     * @return InfoLicense
     */
    public function setName(string $name): InfoLicense
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     *
     * @return InfoLicense
     */
    public function setUrl(?string $url): InfoLicense
    {
        $this->url = $url;
        return $this;
    }
}
