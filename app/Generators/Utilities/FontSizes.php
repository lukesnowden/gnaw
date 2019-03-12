<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Media;

class FontSizes extends SelectorGenerator implements Generator
{

    use Media;

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
            foreach( config( 'gnaw.text.font-sizes' ) as $name => $details ) {
                $fontSize = gnaw_dot_notation( $details['font-size'] ) . 'px';
                $lineHeight = line_height( (int) $fontSize );

                $content .= ".{$prefix}font-size\:{$name} {\n";
                $content .= "   font-size: {$fontSize};\n";
                $content .= "   line-height: {$lineHeight};\n";
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
