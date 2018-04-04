<?php

namespace Ensphere\Gnaw\Traits;

trait Media
{

    /**
     * @param $callback
     */
    protected function mediarize( $callback )
    {
        $medias = array_merge( [ '' => [ 'padding' => 0, 'size' => 0 ] ], gnaw_config( 'gnaw.container.sizes' ) );
        foreach( $medias as $name => $details ) {
            $callback( preg_replace( "/^--$/", "", "{$name}--" ), $details['size'] );
        }
    }

}
