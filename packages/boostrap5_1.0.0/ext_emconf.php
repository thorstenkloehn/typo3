<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Boostrap5',
    'description' => 'Boostrap 5',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'bootstrap_package' => '15.0.0-15.99.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Thorsten\\Boostrap5\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Thorsten Klöhn',
    'author_email' => 'thorstenkloehn@gmail.com',
    'author_company' => 'thorsten',
    'version' => '1.0.0',
];
