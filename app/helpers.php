<?php

function gnaw_config( $selector )
{
    $value = config( $selector );
    if( str_contains( $value, '.' ) ) {
        return config( $value );
    }
    return $value;
}
