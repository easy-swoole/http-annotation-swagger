<?php

namespace App\Swagger\Property;

/**
 * 授权
 * @document https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.3.md#securitySchemeObject
 */
class Security extends BaseProperty
{
    /**
     * @var string
     */
    protected $key;

    /**
     * 类型
     * @var string
     */
    protected $type;

    private $allowType = [
        'apiKey',
        'http',
        'oauth2',
        'openIdConnect'
    ];

    /**
     * key 名称
     * @var string|null
     */
    protected $name;

    /**
     * 请求类型
     * @var string|null
     */
    protected $in;

    private $allowIn = [
        'query',
        'header',
        'cookie'
    ];

    /**
     * @var string|null
     */
    protected $scheme;

    /**
     * 描述
     * @var string|null
     */
    protected $description;

    /**
     * 流
     * @var SecurityFlow[]|null
     */
    protected $flows;

    /**
     * @var string|null
     */
    protected $bearerFormat;

    /**
     * @var string|null
     */
    protected $openIdConnectUrl;

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
     * @return Security
     */
    public function setType(string $type): Security
    {
        $this->type = $type;
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
     * @return Security
     */
    public function setName(?string $name): Security
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIn(): ?string
    {
        return $this->in;
    }

    /**
     * @param string|null $in
     *
     * @return Security
     */
    public function setIn(?string $in): Security
    {
        $this->in = $in;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    /**
     * @param string|null $scheme
     *
     * @return Security
     */
    public function setScheme(?string $scheme): Security
    {
        $this->scheme = $scheme;
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
     * @return Security
     */
    public function setDescription(?string $description): Security
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getFlows(): ?array
    {
        return $this->flows;
    }

    /**
     * @param array|null $flows
     *
     * @return Security
     */
    public function setFlows(?array $flows): Security
    {
        $this->flows = $flows;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBearerFormat(): ?string
    {
        return $this->bearerFormat;
    }

    /**
     * @param string|null $bearerFormat
     *
     * @return Security
     */
    public function setBearerFormat(?string $bearerFormat): Security
    {
        $this->bearerFormat = $bearerFormat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOpenIdConnectUrl(): ?string
    {
        return $this->openIdConnectUrl;
    }

    /**
     * @param string|null $openIdConnectUrl
     *
     * @return Security
     */
    public function setOpenIdConnectUrl(?string $openIdConnectUrl): Security
    {
        $this->openIdConnectUrl = $openIdConnectUrl;
        return $this;
    }

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
     * @return Security
     */
    public function setKey(string $key): Security
    {
        $this->key = $key;
        return $this;
    }

    public function generate(): array
    {
        if (!in_array($this->getType(), $this->allowType)) {
            throw new \Exception("params type [{$this->getType()}] error".',only support ' . implode(',', $this->allowType));
        }

        if (!empty($this->getIn()) && !in_array($this->getIn(), $this->allowIn)) {
            throw new \Exception("params in [{$this->getIn()}] error". ', only support ' . implode(',', $this->allowIn));
        }
        return parent::generate();
    }
}
