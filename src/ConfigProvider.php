<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace EasySwoole\HttpAnnotation\Swagger;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [

            ],
            'publish' => [
                [
                    'id' => 'swagger',
                    'description' => 'The config for swagger.',
                    'source' => __DIR__ . '/Configs/swagger.php',
                    'destination' => EASYSWOOLE_ROOT . '/App/Configs/swagger.php',
                ],
            ],
        ];
    }
}
