<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

/**
 * 联系
 *
 * @link Info
 */
class InfoContact extends BaseProperty
{
    /**
     * @var string|null $email
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $url;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return InfoContact
     */
    public function setEmail(?string $email): InfoContact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return InfoContact
     */
    public function setName(?string $name): InfoContact
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
     * @return InfoContact
     */
    public function setUrl(?string $url): InfoContact
    {
        $this->url = $url;
        return $this;
    }
}
