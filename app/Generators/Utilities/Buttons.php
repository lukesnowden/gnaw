<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Media;

class Buttons extends SelectorGenerator implements Generator
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
            foreach( config( 'gnaw.buttons.types' ) as $typeName => $details ) {

                $background = gnaw_config( "gnaw.buttons.types.{$typeName}.background" ) ?: gnaw_config( 'gnaw.buttons.background' );
                $color = gnaw_config( "gnaw.buttons.types.{$typeName}.color" ) ?: gnaw_config( 'gnaw.buttons.color' );
                $borderColor = gnaw_config( "gnaw.buttons.types.{$typeName}.border-color" ) ?: gnaw_config( 'gnaw.buttons.border-color' );
                $borderSize = gnaw_config( "gnaw.buttons.types.{$typeName}.border-size" ) !== null ? gnaw_config( "gnaw.buttons.types.{$typeName}.border-size" ) : gnaw_config( 'gnaw.buttons.border-size' );
                $borderRadius = gnaw_config( "gnaw.buttons.types.{$typeName}.border-radius" ) ?: gnaw_config( 'gnaw.buttons.border-radius' );
                $borderStyle = gnaw_config( "gnaw.buttons.types.{$typeName}.border-style" ) ?: gnaw_config( 'gnaw.buttons.border-style' );
                $transition = gnaw_config( "gnaw.buttons.types.{$typeName}.transition" ) ?: gnaw_config( 'gnaw.buttons.transition' );
                $padding = gnaw_config( "gnaw.buttons.types.{$typeName}.padding" ) ?: gnaw_config( 'gnaw.buttons.padding' );

                $content .= ".{$prefix}button\:{$typeName}{\n";
                $content .= "\tdisplay: inline-block;\n";
                $content .= "\tcursor: pointer;\n";
                $content .= "\ttext-align: center;\n";
                $content .= "\ttransition: {$transition};\n";
                $content .= "\tbackground: {$background};\n";
                $content .= "\tcolor: {$color};\n";
                $content .= "\tborder-color: {$borderColor};\n";
                $content .= "\tborder-width: {$borderSize}px;\n";
                $content .= "\tborder-radius: {$borderRadius}px;\n";
                $content .= "\tborder-style: {$borderStyle};\n";
                $content .= "\tpadding: {$padding};\n";
                $content .= "}\n";

                $background = gnaw_config( "gnaw.buttons.types.{$typeName}.hover.background" ) ?: $background;
                $color = gnaw_config( "gnaw.buttons.types.{$typeName}.hover.color" ) ?: $color;
                $borderColor = gnaw_config( "gnaw.buttons.types.{$typeName}.hover.border-color" ) ?: $borderColor;
                $borderSize = gnaw_config( "gnaw.buttons.types.{$typeName}.hover.border-size" ) ?: $borderSize;
                $borderRadius = gnaw_config( "gnaw.buttons.types.{$typeName}.hover.border-radius" ) ?: $borderRadius;
                $borderStyle = gnaw_config( "gnaw.buttons.types.{$typeName}.hover.border-style" ) ?: $borderStyle;

                $content .= ".{$prefix}button\:{$typeName}:hover {\n";
                $content .= "\tbackground: {$background};\n";
                $content .= "\tcolor: {$color};\n";
                $content .= "\tborder-color: {$borderColor};\n";
                $content .= "\tborder-width: {$borderSize}px;\n";
                $content .= "\tborder-radius: {$borderRadius}px;\n";
                $content .= "\tborder-style: {$borderStyle};\n";
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
