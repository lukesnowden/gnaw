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
        $medias = $this->medias;
        array_unshift( $medias, '' );
        foreach( $medias as $media ) {
            $callback( preg_replace( "/^--$/", "", "{$media}--" ) );
        }
    }

}
