<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Ahrensburg',
    'description' => 'Ahrensburg Template',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'fluid_styled_content' => '13.4.0-13.4.99',
            'rte_ckeditor' => '13.4.0-13.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Thorsten\\Ahrensburg\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Thorsten Klöhn',
    'author_email' => 'thorstenkloehn@gmail.com',
    'author_company' => 'Thorsten',
    'version' => '1.0.0',
];
