<?php

namespace App\Swagger\Property;

use stdClass;

class PathResponse extends BaseProperty
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var PathRequestBodyContent[]
     */
    protected $content;

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
     * @return PathResponse
     */
    public function setKey(string $key): PathResponse
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return PathResponse
     */
    public function setDescription(?string $description): PathResponse
    {
        $this->description = $description;
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
     * @return PathResponse
     */
    public function setContent(array $content): PathResponse
    {
        $this->content = $content;
        return $this;
    }

    public function generate(): array
    {
        $result = parent::generate();
        foreach ($result['content'] as $name => $value) {
            if ($value !== []) {
                continue;
            }
            $result['content'][$name] = new stdClass();
        }
        return $result;
    }
}
