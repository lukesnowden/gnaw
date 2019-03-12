<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Media;
use LukeSnowden\Gnaw\Traits\Spacing as SpacingTrait;

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

                    $content .= ".{$prefix}{$type}\:{$name} {\n";
                    $content .= "\t{$type}: {$value}px;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}{$type}-y-axis\:{$name} {\n";
                    $content .= "\t{$type}-top: {$value}px;\n";
                    $content .= "\t{$type}-bottom: {$value}px;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}{$type}-x-axis\:{$name} {\n";
                    $content .= "\t{$type}-left: {$value}px;\n";
                    $content .= "\t{$type}-right: {$value}px;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}{$type}\:none {\n";
                    $content .= "\t{$type}: 0;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}{$type}-y-axis\:none {\n";
                    $content .= "\t{$type}-top: 0;\n";
                    $content .= "\t{$type}-bottom: 0;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}{$type}-x-axis\:none {\n";
                    $content .= "\t{$type}-left: 0;\n";
                    $content .= "\t{$type}-right: 0;\n";
                    $content .= "}\n";

                    foreach( $this->spacingPositions as $position ) {
                        $content .= ".{$prefix}{$type}-{$position}\:{$name} {\n";
                        $content .= "\t{$type}-{$position}: {$value}px;\n";
                        $content .= "}\n";
                        $content .= ".{$prefix}{$type}-{$position}\:none {\n";
                        $content .= "\t{$type}-{$position}: 0;\n";
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
