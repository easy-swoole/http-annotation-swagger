<?php

namespace App\Swagger\Property;

class SecurityFlow extends BaseProperty
{
    /**
     * @var string
     */
    protected $key;

    private $allowKey = [
        'implicit',
        'password',
        'clientCredentials',
        'authorizationCode'
    ];

    /**
     * @var string|null
     */
    protected $authorizationUrl;

    /**
     * @var string|null
     */
    protected $tokenUrl;

    /**
     * @var string|null
     */
    protected $refreshUrl;

    /**
     * @var array|null
     */
    protected $scopes;

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
     * @return SecurityFlow
     */
    public function setKey(string $key): SecurityFlow
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorizationUrl(): ?string
    {
        return $this->authorizationUrl;
    }

    /**
     * @param string|null $authorizationUrl
     *
     * @return SecurityFlow
     */
    public function setAuthorizationUrl(?string $authorizationUrl): SecurityFlow
    {
        $this->authorizationUrl = $authorizationUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTokenUrl(): ?string
    {
        return $this->tokenUrl;
    }

    /**
     * @param string|null $tokenUrl
     *
     * @return SecurityFlow
     */
    public function setTokenUrl(?string $tokenUrl): SecurityFlow
    {
        $this->tokenUrl = $tokenUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRefreshUrl(): ?string
    {
        return $this->refreshUrl;
    }

    /**
     * @param string|null $refreshUrl
     *
     * @return SecurityFlow
     */
    public function setRefreshUrl(?string $refreshUrl): SecurityFlow
    {
        $this->refreshUrl = $refreshUrl;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    /**
     * @param array|null $scopes
     *
     * @return SecurityFlow
     */
    public function setScopes(?array $scopes): SecurityFlow
    {
        $this->scopes = $scopes;
        return $this;
    }

    public function generate(): array
    {
        if (!in_array($this->getKey(), $this->allowKey)) {
            throw new \Exception("params type [{$this->getKey()}] error". ', only support ' . implode(',', $this->allowKey));
        }

        return parent::generate();
    }

}
