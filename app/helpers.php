<?php

/**
 * @param $selector
 * @return \Illuminate\Config\Repository|mixed
 */
function gnaw_config( $selector )
{
    $value = config( $selector );
    if( is_string( $value ) && str_contains( $value, '.' ) ) {
        return config( 'gnaw.' . $value );
    }
    return $value;
}

/**
 * @param $fontSize
 * @param $percentage
 * @return string
 */
function line_height( $fontSize, $percentage )
{
    return gnaw_config( $fontSize ) + ( ( gnaw_config( $fontSize ) / 100 ) * gnaw_config( $percentage ) ) . 'px';
}
