<?php

namespace Ensphere\Gnaw\Generators\Utilities;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Media;

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
            foreach( config( 'gnaw.spacing' ) as $spacingName => $spacingValue ) {
                foreach( config( 'gnaw.buttons.colors' ) as $colorName => $colorDetails ) {

                    $backgroundColor = gnaw_config( "gnaw.colors.{$colorName}.default" );
                    $color = gnaw_config( "gnaw.buttons.colors.{$colorName}.font-color" );
                    $borderColor = gnaw_config( "gnaw.buttons.colors.{$colorName}.border-color" );
                    $padding = gnaw_config( "gnaw.spacing.{$spacingName}" );
                    $borderRadius = gnaw_config( "gnaw.buttons.border-radius" );
                    $borderSize = gnaw_config( "gnaw.buttons.border-size" );
                    $gradient = (bool) gnaw_config( "gnaw.buttons.gradient" );
                    $transition = config( "gnaw.buttons.transition" );
                    $paddingX2 = $padding * 3;

                    $content .= ".{$prefix}button\:{$spacingName}\:{$colorName} {\n";
                    $content .= "   display: inline-block;\n";
                    $content .= "   text-align: center;\n";
                    $content .= "   padding: {$padding}px {$paddingX2}px;\n";
                    $content .= "   background-color: {$backgroundColor};\n";
                    if( $gradient ) {
                        $content .= "   background-image: linear-gradient(180deg,hsla(0,0%,100%,0),rgba(0,0,0,.2));\n";
                    }
                    $content .= "   border-width: {$borderSize}px;\n";
                    $content .= "   border-style: solid;\n";
                    $content .= "   border-color: {$borderColor};\n";
                    $content .= "   transition: {$transition};\n";
                    $content .= "   border-radius: {$borderRadius}px;\n";
                    $content .= "   color: {$color};\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}button\:{$spacingName}\:{$colorName}\:inverted {\n";
                    $content .= "   display: inline-block;\n";
                    $content .= "   text-align: center;\n";
                    $content .= "   padding: {$padding}px {$paddingX2}px;\n";
                    $content .= "   background-color: {$color};\n";
                    if( $gradient ) {
                        $content .= "   background-image: linear-gradient(180deg,hsla(0,0%,100%,0),rgba(0,0,0,.2));\n";
                    }
                    $content .= "   border-style: solid;\n";
                    if( ! $borderSize ) {
                        $content .= "   border-width: 1px;\n";
                    } else {
                        $content .= "   border-width: {$borderSize}px;\n";
                    }
                    $content .= "   border-color: {$borderColor};\n";
                    $content .= "   transition: {$transition};\n";
                    $content .= "   border-radius: {$borderRadius}px;\n";
                    $content .= "   color: {$backgroundColor};\n";
                    $content .= "}\n";

                    if( config( "gnaw.buttons.colors.{$colorName}.hover" ) ) {
                        $color = gnaw_config( "gnaw.buttons.colors.{$colorName}.hover.font-color" );
                        $backgroundColor = gnaw_config( "gnaw.buttons.colors.{$colorName}.hover.background-color" );
                        $content .= ".{$prefix}button\:{$spacingName}\:{$colorName}\:inverted:hover {\n";
                        if( $color ) {
                            $content .= "   color: {$color};\n";
                        }
                        if( $backgroundColor ) {
                            $content .= "   background-color: {$backgroundColor};\n";
                        }
                        $content .= "}\n";
                    }

                    if( config( "gnaw.buttons.colors.{$colorName}.hover" ) ) {
                        $color = gnaw_config( "gnaw.buttons.colors.{$colorName}.hover.font-color" );
                        $backgroundColor = gnaw_config( "gnaw.buttons.colors.{$colorName}.hover.background-color" );
                        $content .= ".{$prefix}button\:{$spacingName}\:{$colorName}:hover {\n";
                        if( $color ) {
                            $content .= "   color: {$color};\n";
                        }
                        if( $backgroundColor ) {
                            $content .= "   background-color: {$backgroundColor};\n";
                        }
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
