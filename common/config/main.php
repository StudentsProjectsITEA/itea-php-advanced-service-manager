<?php

use common\components\CategoryService;
use common\repositories\CategoryRepository;
use yii\di\Instance;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'container' => [
        'singletons' => [
            CategoryRepository::class,
            CategoryService::class => [
                [],
                [
                    Instance::of(CategoryRepository::class),
                ],
            ],
        ],
    ],
];
