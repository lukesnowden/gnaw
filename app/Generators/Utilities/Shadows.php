<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Color;
use LukeSnowden\Gnaw\Traits\Media;

class Shadows extends SelectorGenerator implements Generator
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
            foreach( (array) config( 'gnaw.shadows.box' ) as $name => $settings ) {

                $hOffset = isset( $settings['hOffset'] ) ? gnaw_config( "gnaw.shadows.box.{$name}.hOffset" ) . 'px' : '0px';
                $vOffset = isset( $settings['vOffset'] ) ? gnaw_config( "gnaw.shadows.box.{$name}.vOffset" ) . 'px' : '0px';
                $blur = isset( $settings['blur'] ) ? gnaw_config( "gnaw.shadows.box.{$name}.blur" ) . 'px' : '0px';
                $spread = isset( $settings['spread'] ) ? gnaw_config( "gnaw.shadows.box.{$name}.spread" ) . 'px' : '0px';
                $color = isset( $settings['color'] ) ? gnaw_config( "gnaw.shadows.box.{$name}.color" ) : '#000000';

                $content .= ".{$prefix}box-shadow\:{$name} {\n";
                $content .= "box-shadow: {$hOffset} {$vOffset} {$blur} {$spread} {$color};\n";
                $content .= "}\n";
            }

            foreach( (array) config( 'gnaw.shadows.text' ) as $name => $settings ) {

                $hOffset = isset( $settings['hOffset'] ) ? gnaw_config( "gnaw.shadows.text.{$name}.hOffset" ) . 'px' : '0px';
                $vOffset = isset( $settings['vOffset'] ) ? gnaw_config( "gnaw.shadows.text.{$name}.vOffset" ) . 'px' : '0px';
                $blur = isset( $settings['blur'] ) ? gnaw_config( "gnaw.shadows.text.{$name}.blur" ) . 'px' : '0px';
                $color = isset( $settings['color'] ) ? gnaw_config( "gnaw.shadows.text.{$name}.color" ) : '#000000';

                $content .= ".{$prefix}text-shadow\:{$name} {\n";
                $content .= "text-shadow: {$hOffset} {$vOffset} {$blur} {$color};\n";
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
