<?php

namespace Ensphere\Gnaw\Generators\Utilities;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Color;
use Ensphere\Gnaw\Traits\Media;

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
                foreach( config( 'gnaw.colors' ) as $colour => $shades ) {
                    $content .= ".{$prefix}" . $type . '\:light-' . $colour . " {\n";
                    $content .= "\t{$type}: " . '$color--light-' . "{$colour};\n";
                    $content .= "}\n";
                    $content .= ".{$prefix}" . $type . '\:' . $colour . " {\n";
                    $content .= "\t{$type}: " . '$color--' . "{$colour};\n";
                    $content .= "}\n";
                    $content .= ".{$prefix}" . $type . '\:dark-' . $colour . " {\n";
                    $content .= "\t{$type}: " . '$color--dark-' . "{$colour};\n";
                    $content .= "}\n";
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
