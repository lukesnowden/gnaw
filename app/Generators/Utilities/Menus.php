<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Media;

class Menus extends SelectorGenerator implements Generator
{

    use Media;

    /**
     * @var array
     */
    protected $directions = [
        'vertical',
        'horizontal'
    ];

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile
    {
        $file = new GnawFile();
        $content = '';

        $this->mediarize( function( $prefix, $size ) use ( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            foreach( $this->directions as $direction ) {
                foreach( config( 'gnaw.spacing' ) as $spacingName => $spacingValue ) {

                    $fontSize = gnaw_config( "gnaw.text.font-sizes.{$spacingName}.font-size" ) . 'px';
                    $lineHeight = line_height( (int) $fontSize );
                    $space = gnaw_config( "gnaw.spacing.{$spacingName}" );
                    $padding = ( $space / 2 ) . "px {$space}px";

                    $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} {\n";
                    $content .= "display: inline-block;\n";
                    $content .= "position: relative;\n";
                    $content .= "list-style:none;\n";
                    $content .= "font-size: {$fontSize};\n";
                    $content .= "line-height: {$lineHeight};\n";
                    $content .= "background-color:inherit;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} div {\n";
                    $content .= "position:relative;\n";
                    $content .= "background-color:inherit;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} > div {\n";
                    $content .= "display: inline-block;\n";
                    $content .= "color: inherit;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} > div > a {\n";
                    $content .= "display: block;\n";
                    $content .= "color: inherit;\n";
                    $content .= "padding: {$padding};\n";
                    $content .= "}\n";

                    if( $direction === 'horizontal' ) {

                        $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} nav {\n";
                        $content .= "position:absolute;\n";
                        $content .= "top:100%;\n";
                        $content .= "left:0;\n";
                        $content .= "z-index:2;\n";
                        $content .= "list-style:none;\n";
                        $content .= "width: auto;\n";
                        $content .= "display: none;\n";
                        $content .= "min-width: 300px;\n";
                        $content .= "background-color:inherit;\n";
                        $content .= "}\n";

                        $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} nav a {\n";
                        $content .= "display: block;\n";
                        $content .= "color: inherit;\n";
                        $content .= "padding: {$padding};\n";
                        $content .= "}\n";

                        $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} div:hover > nav {\n";
                        $content .= "display: block;\n";
                        $content .= "}\n";

                        $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} > div > nav nav {\n";
                        $content .= "left: 100%;\n";
                        $content .= "top: 0;\n";
                        $content .= "}\n";

                    }

                }

                $content .= ".{$prefix}menu-type\:mega nav {\n";
                $content .= "position:static;\n";
                $content .= "}\n";

                $content .= ".{$prefix}menu-type\:mega > div {\n";
                $content .= "position:static;\n";
                $content .= "}\n";

                $content .= ".{$prefix}menu-type\:mega > div > nav {\n";
                $content .= "position:absolute;\n";
                $content .= "top:100%;\n";
                $content .= "left:0;\n";
                $content .= "right:0;\n";
                $content .= "}\n";

                $content .= ".{$prefix}menu-type\:mega > div:hover > nav {\n";
                $content .= "display:flex;\n";
                $content .= "min-height:300px;\n";
                $content .= "}\n";

                $content .= ".{$prefix}menu-type\:mega > div:hover > nav nav {\n";
                $content .= "display:block;\n";
                $content .= "}\n";

                $content .= ".{$prefix}menu-type\:mega > div > nav > div {\n";
                $content .= "flex: 0 1 calc( 100% / 5);\n";
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
