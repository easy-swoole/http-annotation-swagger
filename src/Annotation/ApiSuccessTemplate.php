<?php

namespace EasySwoole\HttpAnnotation\Swagger\Annotation;


use EasySwoole\Annotation\AbstractAnnotationTag;

/**
 * Class ApiResponseParam
 * @package EasySwoole\HttpAnnotation\AnnotationTag
 * @Annotation
 */
class ApiSuccessTemplate extends AbstractAnnotationTag
{
    public $code;

    public $msg;

    public $result;

    public $template;


    public function tagName(): string
    {
        return 'ApiSuccessTemplate';
    }
}
