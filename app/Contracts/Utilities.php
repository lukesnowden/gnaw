<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\PCSSBuilder;
use Ensphere\Gnaw\Traits\Color;
use Ensphere\Gnaw\Traits\Media;
use Ensphere\Gnaw\Traits\Size;
use Ensphere\Gnaw\Traits\Spacing;

class Utilities implements PCSSBuilder
{

    use Color, Size, Media, Spacing;

    /**
     * @var array
     */
    protected $files = [];

    protected $percentageWidths = [
        'five' => 5,
        'ten' => 10,
        'fifteen' => 15,
        'twenty' => 20,
        'twenty-five' => 25,
        'thirty' => 30,
        'thirty-five' => 35,
        'fourty' => 40,
        'fourty-five' => 45,
        'fifty' => 50,
        'fifty-five' => 55,
        'sixty' => 60,
        'sixty-five' => 65,
        'seventy' => 70,
        'seventy-five' => 75,
        'eighty' => 80,
        'eighty-five' => 85,
        'ninety' => 90,
        'ninety-five' => 95
    ];

    /**
     * @return void
     */
    protected function colors()
    {
        $colorFile = new GnawFile();
        $colorFile->filename( 'colors.pcss' );
        $colorFile->path( 'utilities' );
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

        $colorFile->content( $content );
        $this->files[] = $colorFile;
    }

    /**
     * @return void
     */
    protected function columns()
    {
        $columnFile = new GnawFile();
        $columnFile->filename( 'columns.pcss' );
        $columnFile->path( 'utilities' );
        $content = '';

        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            $content .= ".{$prefix}col\:full-width {\n";
            $content .= "\twidth: 100%;\n";
            $content .= "\tfloat: none;\n";
            $content .= "}\n";
            foreach( $this->percentageWidths as $name => $value ) {
                $content .= ".{$prefix}percent-col\:{$name} {\n";
                $content .= "\twidth: {$value}%;\n";
                $content .= "\tfloat: left;\n";
                $content .= "}\n";
            }
            $maxColumns = [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ];
            $gutterSize = gnaw_config( 'gnaw.container.column-gutter-size' );
            while( $maxColumns ) {
                $count = array_shift( $maxColumns );
                for( $x = 1; $x < $count; $x++ ) {
                    $content .= ".{$prefix}col\:{$x}-of-{$count} {\n";
                    $content .= "   width: calc( 100% * {$x}/{$count} - ( {$gutterSize}px - {$gutterSize}px * {$x}/{$count} ) );\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}col\:{$x}-of-{$count}:nth-child(1n) {\n";
                    $content .= "    float: left;\n";
                    $content .= "    margin-right: {$gutterSize}px;\n";
                    $content .= "    clear: none;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}col\:{$x}-of-{$count}:last-child {\n";
                    $content .= "    margin-right: 0;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}col\:{$x}-of-{$count}:nth-child({$count}n) {\n";
                    $content .= "    margin-right: 0;\n";
                    $content .= "    float: right;\n";
                    $content .= "}\n";

                    $content .= ".{$prefix}col\:{$x}-of-{$count}:nth-child({$count}n+1) {\n";
                    $content .= "    clear: both;\n";
                    $content .= "}\n";
                }
            }
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $columnFile->content( $content );
        $this->files[] = $columnFile;
    }

    /**
     * @return void
     */
    protected function helpers()
    {
        $helpersFile = new GnawFile();
        $helpersFile->filename( 'helpers.pcss' );
        $helpersFile->path( 'utilities' );
        $content = '';

        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            $content .= ".{$prefix}full-width { width:100%; max-width:100%; }\n";
            $content .= ".{$prefix}not-a-list { list-style: none; margin: 0; padding: 0; }\n";
            $content .= ".{$prefix}float\:left { float:left; }\n";
            $content .= ".{$prefix}float\:right { float:right; }\n";
            $content .= ".{$prefix}float\:none { float:none; }\n";
            $content .= ".{$prefix}round { border-radius:100%; overflow: hidden; }\n";
            $content .= ".{$prefix}children\:same-height { display: flex; }\n";
            $content .= ".{$prefix}children\:same-height > * { flex: 1 1 auto; }\n";
            $content .= ".{$prefix}child\:vertically-aligned { position:relative; }\n";
            $content .= ".{$prefix}child\:vertically-aligned > * { position:relative; top: 50%; transform: translateY(-50%); }\n";
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $helpersFile->content( $content );
        $this->files[] = $helpersFile;
    }

    /**
     * @return void
     */
    protected function spacing()
    {

        $spacingFile = new GnawFile();
        $spacingFile->filename( 'spacing.pcss' );
        $spacingFile->path( 'utilities' );
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

        $spacingFile->content( $content );
        $this->files[] = $spacingFile;
    }

    /**
     * @return void
     */
    protected function buttons()
    {
        $buttonsFile = new GnawFile();
        $buttonsFile->filename( 'buttons.pcss' );
        $buttonsFile->path( 'utilities' );
        $content = '';

        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            foreach( config( 'gnaw.spacing' ) as $spacingName => $spcingValue ) {
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

        $buttonsFile->content( $content );
        $this->files[] = $buttonsFile;

    }

    /**
     * @return array
     */
    public function generateFiles() : array
    {
        $this->colors();
        $this->columns();
        $this->spacing();
        $this->helpers();
        $this->buttons();
        $this->fontSizes();
        return $this->files;
    }

    /**
     * @return void;
     */
    protected function fontSizes()
    {
        $file = new GnawFile();
        $file->filename( 'font-sizes.pcss' );
        $file->path( 'utilities' );
        $content = '';

        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            foreach( config( 'gnaw.text.font-sizes' ) as $name => $details ) {
                $fontSize = gnaw_dot_notation( $details['font-size'] ) . 'px';
                $content .= ".{$prefix}font-size\:{$name} {\n";
                $content .= "   font-size: {$fontSize};\n";
                $content .= "}\n";
            }
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        $this->files[] = $file;
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        $replacements = [];
        foreach( config( 'gnaw.colors' ) as $color => $shades ) {
            $replacements["\$color--{$color}"] = $shades['default'];
            $replacements["\$color--light-{$color}"] = $shades['light'];
            $replacements["\$color--dark-{$color}"] = $shades['dark'];
        }
        return $replacements;
    }

}
