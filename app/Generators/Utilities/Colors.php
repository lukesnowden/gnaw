<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Color;
use LukeSnowden\Gnaw\Traits\Media;

class Colors extends SelectorGenerator implements Generator
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
            foreach( $this->colorTypes as $type ) {
                foreach( config( 'gnaw.colors' ) as $colour => $hexCode ) {
                    $content .= ".{$prefix}{$type}\:{$colour},\n";
                    $content .= ".{$prefix}{$type}\:{$colour}:visited {\n";
                    $content .= "\t{$type}: {$hexCode};\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}{$type}\:{$colour}\:hover:hover {\n";
                    $content .= "\t{$type}: {$hexCode};\n";
                    $content .= "}\n";

                    if( $type === 'color' ) {
                        $content .= ".{$prefix}placeholder-{$type}\:{$colour}::placeholder {\n";
                        $content .= "\t{$type}: {$hexCode} !important;\n";
                        $content .= "}\n";
                    }
                }
            }
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        return $file;
    }

}
