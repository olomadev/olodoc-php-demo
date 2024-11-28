<?php

/**
 * Navigation index
 */
return [
    [
        'label' => $translator->translate('Introduction'),
        'url' => '/index.html',
    ],
    [
        'label' => $translator->translate('Installation'),
        'url' => '/installation.html',
    ],
    [
        'label' => $translator->translate('Generating Docs'),
        'url' => '/generating-docs.html',
    ],
    [
        'label' => $translator->translate('Configuration'),
        'url' => '/configuration.html',
    ],
    [
        'label' => $translator->translate('Markdown Guide'),
        'url' => '/markdown-guide/index.html',
        'folder' => '/markdown-guide',
        'children' => [
            [
                'label' => $translator->translate('Markdown Guide'),
                'url' => '/markdown-guide/index.html',
            ],
            [
                'label' => $translator->translate('Basic Syntax'),
                'folder' => '/markdown-guide/basic-syntax',
                'url' => '/markdown-guide/basic-syntax/index.html',
                'children' => [
                    [
                        'label' => $translator->translate('Basic Syntax'),
                        'url' => '/markdown-guide/basic-syntax/index.html'
                    ],
                ]
            ],
            [
                'label' => $translator->translate('Extended Syntax'),
                'folder' => '/markdown-guide/extended-syntax',
                'url' => '/markdown-guide/extended-syntax/index.html',
                'children' => [
                    [
                        'label' => 'Extended Syntax',
                        'url' => '/markdown-guide/extended-syntax/index.html'
                    ],
                ]
            ],
        ]
    ],
    [
        'label' => $translator->translate('I18n'),
        'url' => '/i18n.html',
    ],
    [
        'label' => $translator->translate('Customizations'),
        'url' => '/customizations.html',
    ],
    [
        'label' => $translator->translate('Prism Js'),
        'url' => '/prism-js.html',
    ],
];
