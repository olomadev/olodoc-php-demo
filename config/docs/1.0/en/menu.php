<?php

# navigation
# 

// return [
//     [
//         'label' => 'Overview',
//         'url' => '/index.html',
//         'meta' => [
//             'title' => 'a',
//             'keywords' => 'b',
//             'description' => 'c',
//         ]
//     ]
// ];

// return [
//     [
//         'label' => 'Introduction',
//         'url' => '/index.html',
//         'meta' => [
//             'title' => 'i1',
//             'keywords' => 'i2',
//             'description' => 'i3',
//         ]
//     ],
//     [
//         'label' => 'Layouts',
//         'url' => '/layouts/index.html',
//         'folder' => 'layouts',
//         'children' => [
//             [
//                 'label' => 'Introduction',
//                 'url' => '/layouts/index.html',
//                 'meta' => [
//                     'title' => 'L1',
//                     'keywords' => 'L2',
//                     'description' => 'L3',
//                 ],  
//             ],
//             [
//                 'label' => 'Admin',
//                 'url' => '/layouts/admin.html'
//             ],
//             [
//                 'label' => 'List',
//                 'url' => '/layouts/list.html'
//             ],
//             [
//                 'label' => 'Show',
//                 'url' => '/layouts/show.html'
//             ],
//             [
//                 'label' => 'Form',
//                 'url' => '/layouts/form.html'
//             ],
//             [
//                 'label' => 'Messages',
//                 'url' => '/layouts/messages.html'
//             ],
//         ],
//     ],
//     [
//         'label' => 'Installation',
//         'url' => '/installation.html'
//     ],
// ];

return [
    [
        'label' => 'Index', 
        'url' => '/index.html',
        'meta' => [
            'title' => 'z',
            'keywords' => 'x',
            'description' => 'y',
        ],
    ],
    [
        'label' => 'Php Api', 
        'folder' => 'php-api', 
        'url' => '/php-api/index.html',
        'children' => [
            [
                'label' => 'Index',
                'url' => '/php-api/index.html',
                'meta' => [
                    'title' => 'a',
                    'keywords' => 'b',
                    'description' => 'c',
                ],
            ],
        ],
    ],
    [
        'label' => 'Olobase UI', 
        'folder' => 'ui', 
        'url' => '/ui/index.html',
        'children' => [
            [
                'label' => 'Introduction',
                'url' => '/ui/index.html',
                'meta' => [
                    'title' => 'a',
                    'keywords' => 'b',
                    'description' => 'c',
                ],
            ],
            [
                'label' => 'Installation',
                'url' => '/ui/installation.html',
                'meta' => [
                    'title' => 'Installation',
                    'keywords' => 'installation, olobase',
                    'description' => 'Framework setup description',
                ],                
            ],
            [
                'label' => 'Layouts',
                'url' => '/ui/layouts/index.html',
                'folder' => 'ui/layouts',
                'meta' => [
                    'title' => 'la',
                    'keywords' => 'lb',
                    'description' => 'lc',
                ],
                'children' => [
                    [
                        'label' => 'Introduction',
                        'url' => '/ui/layouts/index.html',
                    ],
                    [
                        'label' => 'Admin',
                        'url' => '/ui/layouts/admin.html',
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
    
];

