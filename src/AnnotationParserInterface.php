<?php

namespace App\Swagger;

use App\Swagger\Property\Swagger;

interface AnnotationParserInterface
{
    public function setSwagger(Swagger $swagger);

    public function parser();

    public function setContentTypes(array $contentTypes);

    public function setAccepts(array $accepts);

    public function setTemplates(array $templates);
}
