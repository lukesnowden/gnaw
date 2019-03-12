<?php

namespace LukeSnowden\Gnaw\Generators\Utilities;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Media;

class Columns extends SelectorGenerator implements Generator
{

    use Media;

    /**
     * @var array
     */
    protected $percentageWidths = [
        'five' => 5,
        'ten' => 10,
        'fifteen' => 15,
        'twenty' => 20,
        'twenty-five' => 25,
        'thirty' => 30,
        'thirty-five' => 35,
        'forty' => 40,
        'forty-five' => 45,
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

            $gutterSize = gnaw_config( 'gnaw.container.column-gutter-size' );
            $gridColumn = array_filter( array_unique( (array) gnaw_config( 'gnaw.container.grid-column' ) + [ 12 ] ) );
            while( $gridColumn ) {
                $count = array_shift( $gridColumn );
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

                    $content .= ".{$prefix}col\:row-end:nth-child(1n) {\n";
                    $content .= "    margin-right: 0;\n";
                    $content .= "    float: right;\n";
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
