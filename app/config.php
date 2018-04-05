<?php

return [

    'text' => [

        'color' => 'colors.grey.dark',
        'font-family' => "'Open Sans', Arial, serif",
        'font-size' => '16',
        'line-height-percentage' => '30',

        'headings' => [

            'color' => 'colors.black.default',
            'font-family' => "'BenchNine', sans-serif",
            'spacing' => '20',

            'very-small' => [
                'font-size' => '16'
            ],
            'small' => [
                'font-size' => '18'
            ],
            'medium' => [
                'font-size' => '22'
            ],
            'large' => [
                'font-size' => '34'
            ],
            'very-large' => [
                'font-size' => '56'
            ]

        ],

        'anchors' => [

            'color' => 'colors.blue.dark',
            'hover-color' => 'colors.blue.default',

        ]

    ],
    
    'form' => [

        'border-radius' => '0',
        'border-color' => 'colors.grey.dark',
        'color' => 'colors.black.default',
        'font-size' => 'text.font-size'
        
    ],
    
    'table' => [
        
        'border-style' => 'solid',
        'border-width' => '1',
        'border-color' => 'colors.grey.dark'
        
    ],

    'spacing' => [

        'very-small'    => '5',
        'small'         => '10',
        'medium'        => '20',
        'large'         => '40',
        'very-large'    => '80'

    ],

    'colors' => [

        'white' => [
            'default'   => '#FFFFFF',
            'light'     => '#FFFFFF',
            'dark'      => '#f2f2f2'
        ],

        'black' => [
            'default'   => '#000000',
            'light'     => '#646464',
            'dark'      => '#000000'
        ],

        'blue' => [
            'default'   => '#2980b9',
            'light'     => '#8de4ff',
            'dark'      => '#001c55'
        ],

        'green' => [
            'default'   => '#27ae60',
            'light'     => '#59d98e',
            'dark'      => '#186839'
        ],

        'grey' => [
            'default'   => '#bdc3c7',
            'light'     => '#f1f2f3',
            'dark'      => '#9fa7ad'
        ],

        'orange' => [
            'default'   => '#f39c12',
            'light'     => '#f7c36e',
            'dark'      => '#da8b0b'
        ],

        'yellow' => [
            'default'   => '#f2ca26',
            'light'     => '#f7db6e',
            'dark'      => '#d9b00d'
        ],

        'purple' => [
            'default'   => '#9b59b6',
            'light'     => '#bf95d0',
            'dark'      => '#68367c'
        ],

        'red' => [
            'default'   => '#e74c3c',
            'light'     => '#f1978e',
            'dark'      => '#cc2b19'
        ],

    ],

    'container' => [

        'default-padding' => '10',
        'column-gutter-size' => '50',

        'sizes' => [
            'phablet' => [
                'padding' => '20',
                'break_point' => '320',
                'width' => '320'
            ],
            'tablet' => [
                'padding' => '20',
                'break_point' => '480',
                'width' => '480'
             ],
            'desktop' => [
                'padding' => '20',
                'break_point' => '768',
                'width' => '768'
            ],
            'wide' => [
                'padding' => '20',
                'break_point' => '1200',
                'width' => '1200'
            ],
            'huge' => [
                'padding' => '20',
                'break_point' => '1500',
                'width' => '1200'
            ]
        ]

    ]

];
