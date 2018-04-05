<?php

namespace Ensphere\Gnaw\Traits;

trait Spacing
{

    /**
     * @var int
     */
    protected $baseUnit = 16;

    /**
     * @var array
     */
    protected $spacingTypes = [
        'padding',
        'margin'
    ];

    /**
     * @var array
     */
    protected $spacingPositions = [
        'top',
        'bottom',
        'left',
        'right'
    ];

}
