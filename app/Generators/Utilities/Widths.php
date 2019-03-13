<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Media;

class Widths extends SelectorGenerator implements Generator
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

            foreach( config( 'gnaw.widths' ) as $length => $pixels ) {
                $content .= ".{$prefix}width\:{$length} {\n";
                $content .= "\twidth:{$pixels}px;\n";
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
