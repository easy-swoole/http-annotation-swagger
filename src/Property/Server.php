<?php

namespace App\Swagger\Property;

class Server extends BaseProperty
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var ServerVariable[]|null
     */
    protected $variables;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Server
     */
    public function setUrl(string $url): Server
    {
        $this->url = $url;
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
     * @return Server
     */
    public function setDescription(?string $description): Server
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ServerVariable[]|null
     */
    public function getVariables(): ?array
    {
        return $this->variables;
    }

    /**
     * @param ServerVariable[]|null $variables
     *
     * @return Server
     */
    public function setVariables(?array $variables): Server
    {
        $this->variables = $variables;
        return $this;
    }
}
