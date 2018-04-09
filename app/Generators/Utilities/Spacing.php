<?php

namespace Ensphere\Gnaw\Generators\Utilities;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Media;
use Ensphere\Gnaw\Traits\Spacing as SpacingTrait;

class Spacing extends SelectorGenerator implements Generator
{

    use Media, SpacingTrait;

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
            foreach( $this->spacingTypes as $type ) {
                foreach( config( 'gnaw.spacing' ) as $name => $value ) {
                    $content .= ".{$prefix}" . $type . '\:' . $name . " {\n";
                    $content .= "\t{$type}: " . '$space--' . "{$name};\n";
                    $content .= "}\n";
                    $content .= ".{$prefix}" . $type . '-y-axis\:' . $name . " {\n";
                    $content .= "\t{$type}-top: " . '$space--' . "{$name};\n";
                    $content .= "\t{$type}-bottom: " . '$space--' . "{$name};\n";
                    $content .= "}\n";
                    $content .= ".{$prefix}" . $type . '-x-axis\:' . $name . " {\n";
                    $content .= "\t{$type}-left: " . '$space--' . "{$name};\n";
                    $content .= "\t{$type}-right: " . '$space--' . "{$name};\n";
                    $content .= "}\n";
                    foreach( $this->spacingPositions as $position ) {
                        $content .= ".{$prefix}" . $type . '-' . $position . '\:' . $name . " {\n";
                        $content .= "\t{$type}-{$position}: " . '$space--' . "{$name};\n";
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
