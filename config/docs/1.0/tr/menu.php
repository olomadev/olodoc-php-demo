<?php

# navigation
# 

// return [
//     [
//         'label' => 'Overview',
//         'url' => '/index.html',
//     ]
// ];

return [
    [
        'label' => 'Olobase UI', 
        'folder' => 'ui', 
        'url' => '/ui/index.html',
        'children' => [
            [
                'label' => 'Installation',
                'url' => '/ui/installation.html'
            ],
            [
                'label' => 'Layouts',
                'url' => '/ui/layouts/layouts.html',
                'folder' => 'layouts',
                'children' => [
                    [
                        'label' => 'Admin',
                        'url' => '/ui/layouts/admin.html'
                    ],
                    [
                        'label' => 'List',
                        'url' => '/ui/layouts/list.html'
                    ],
                    [
                        'label' => 'Show',
                        'url' => '/ui/layouts/show.html'
                    ],
                    [
                        'label' => 'Form',
                        'url' => '/ui/layouts/form.html'
                    ],
                    [
                        'label' => 'Messages',
                        'url' => '/ui/layouts/messages.html'
                    ],
                ],
            ],
            [
                'label' => 'Inputs',
                'url' => '/ui/inputs.html'
            ],
            [
                'label' => 'Fields',
                'url' => '/ui/fields.html'
            ],
        ],
    ],
    //
    // another directory
    // 
    //  [
    //     'label' => 'Php Rest Api',
    //     'folder' => 'php-api',
    //     'url' => '/php-api/index.html',
    //     'children' => [

    //     ]
    // ],

];