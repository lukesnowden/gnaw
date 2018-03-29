<?php

namespace Ensphere\Gnaw\Traits;

trait Media
{

    /**
     * @var array
     */
    protected $medias = [
        'tablet',
        'desktop',
        'wide',
        'huge'
    ];

    /**
     * @param $callback
     */
    protected function mediarize( $callback )
    {
        foreach( [ '' ] + $this->medias as $media ) {
            $callback( preg_replace( "/^--$/", "", "{$media}--" ) );
        }
    }

}
