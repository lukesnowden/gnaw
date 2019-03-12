<?php

namespace LukeSnowden\Gnaw\Traits;

trait Media
{

    /**
     * @param $callback
     */
    protected function mediarize( $callback )
    {
        $medias = array_merge( [ '' => [ 'padding' => 0, 'break_point' => 0, 'width' => 0 ] ], gnaw_config( 'gnaw.container.sizes' ) );
        foreach( $medias as $name => $details ) {
            $callback( preg_replace( "/^--$/", "", "{$name}--" ), $details['break_point'] );
        }
    }

}
