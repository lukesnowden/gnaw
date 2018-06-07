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
    if( is_string( $str ) && starts_with( $str, 'gnaw:' ) ) {
        return config( 'gnaw.' . str_replace( 'gnaw:', '', $str ) );
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
    $fontSize = is_string( $fontSize ) ? gnaw_config( $fontSize ) : $fontSize;
    return $fontSize * ( 1 + ( gnaw_config( 'gnaw.text.line-height-percentage' ) / 100 ) ) . 'px';
}
