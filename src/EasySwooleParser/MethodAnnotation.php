<?php


namespace EasySwoole\HttpAnnotation\Swagger\EasySwooleParser;

use EasySwoole\HttpAnnotation\Annotation\MethodAnnotation as BaseMethodAnnotation;

class MethodAnnotation extends BaseMethodAnnotation
{
    protected $apiSuccessTemplate = [];

    /**
     * @return array
     */
    public function getApiSuccessTemplate(): array
    {
        return $this->apiSuccessTemplate;
    }
}