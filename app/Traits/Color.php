<?php

namespace Ensphere\Gnaw\Traits;

trait Color
{

    /**
     * @var array
     */
    protected $colors = [
        'white' => '#FFFFFF',
        'black' => '#000000',
        'blue' => '#2980b9',
        'green' => '#27ae60',
        'grey' => '#bdc3c7',
        'orange' => '#f39c12',
        'yellow' => '#f1c40f',
        'purple' => '#9b59b6',
        'red' => '#e74c3c',
    ];

    /**
     * @param $hex
     * @param $steps
     * @return string
     */
    protected function adjustBrightness( $hex, $steps )
    {
        $steps = max( -255, min( 255, $steps ) );
        $hex = str_replace( '#', '', $hex );
        if( strlen( $hex ) == 3 ) {
            $hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
        }
        $color_parts = str_split( $hex, 2 );
        $return = '#';
        foreach ( $color_parts as $color ) {
            $color   = hexdec( $color );
            $color   = max( 0, min( 255, $color + $steps ) );
            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT );
        }
        return $return;
    }

}
