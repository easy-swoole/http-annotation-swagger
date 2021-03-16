<?php

namespace EasySwoole\HttpAnnotation\Swagger\Property;

use ReflectionClass;
use stdClass;

class BaseProperty
{

    public function generate(): array
    {
        $result = [];
        foreach ($this->getAttributes() as $key => $value) {
            if (empty($value)) {
                continue;
            }
            if (is_array($value)) {
                $data = [];
                foreach ($value as $k => $v) {
                    $item = $v instanceof BaseProperty ? $v->generate() : $v;
                    if (isset($item['key'])) {
                        $k = $item['key'] ?? $k;
                        unset($item['key']);
                    }
                    if (isset($item['type']) && $item['type'] === 'array' && !isset($item['items'])) {
                        $item['items'] = new stdClass();
                        $item['default'] = [];
                        $item['example'] = [];
                    }
                    $data[$k] = $item;
                }
                $value = $data;
            }
            if ($value instanceof BaseProperty) {
                $value = $value->generate();
                if (empty($value)) {
                    continue;
                }
            }
            $result[$key] = $value;
        }
        return $result;
    }

    public function getAttributes(): array
    {
        $data = [];
        $ref = new ReflectionClass(get_called_class());
        $properties = $ref->getProperties(\ReflectionMethod::IS_PROTECTED);
        foreach ($properties as $property) {
            $key = $property->getName();
            $data[$key] = $this->$key;;
        }
        return $data;
    }

}
