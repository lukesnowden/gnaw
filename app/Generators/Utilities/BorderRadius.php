<?php

namespace Ensphere\Gnaw\Generators\Utilities;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Color;
use Ensphere\Gnaw\Traits\Media;

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
