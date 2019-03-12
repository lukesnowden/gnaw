<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Color;
use LukeSnowden\Gnaw\Traits\Media;

class BorderRadius extends SelectorGenerator implements Generator
{

    use Media, Color;

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile
    {
        $file = new GnawFile();
        $content = '';

        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            foreach( config( 'gnaw.spacing' ) as $spacingName => $spacingValue ) {
                $borderRadius = gnaw_config( "gnaw.spacing.{$spacingName}" );
                $content .= ".{$prefix}border-radius\:{$spacingName} {\n";
                $content .= "border-radius: {$borderRadius}px;\n";
                $content .= "}\n";
            }
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        return $file;
    }

}
