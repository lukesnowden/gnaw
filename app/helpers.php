<?php

/**
 * @param $selector
 * @return \Illuminate\Config\Repository|mixed
 */
function gnaw_config( $selector )
{
    $value = config( $selector );
    return gnaw_dot_notation( $value );
}

/**
 * @param $str
 * @return mixed
 */
function gnaw_dot_notation( $str )
{
    if( is_string( $str ) && str_contains( $str, '.' ) ) {
        return config( 'gnaw.' . $str );
    }
    return $str;
}

/**
 * @param $fontSize
 * @param $percentage
 * @return string
 */
function line_height( $fontSize, $percentage = null )
{
    return gnaw_config( $fontSize ) + ( ( gnaw_config( $fontSize ) / 100 ) * gnaw_config( 'gnaw.text.line-height-percentage' ) ) . 'px';
}
