<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\PCSSBuilder;
use Ensphere\Gnaw\Traits\Color;
use Ensphere\Gnaw\Traits\Media;
use Ensphere\Gnaw\Traits\Size;

class Utilities implements PCSSBuilder
{

    use Color, Size, Media;

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @return void
     */
    protected function colors()
    {
        $colorFile = new UtilityFile();
        $colorFile->filename( 'colors.pcss' );
        $colorFile->path( 'utilities/segments' );
        $content = '';

        $this->mediarize( function( $prefix ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(--" . trim( $prefix, '--' ) . ") {\n";
            }
            foreach( $this->colorTypes as $type ) {
                foreach( $this->colors as $colour => $hex ) {
                    $content .= ".{$prefix}" . $type . '\:light-' . $colour . " {\n";
                    $content .= "\t{$type}: " . '$colour--light-' . "{$colour};\n";
                    $content .= "}\n";
                    $content .= ".{$prefix}" . $type . '\:' . $colour . " {\n";
                    $content .= "\t{$type}: " . '$colour--' . "{$colour};\n";
                    $content .= "}\n";
                    $content .= ".{$prefix}" . $type . '\:dark-' . $colour . " {\n";
                    $content .= "\t{$type}: " . '$colour--dark-' . "{$colour};\n";
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
    protected function configs()
    {
        $configFile = new ConfigFile();
        $configFile->filename( 'config.pcss' );
        $configFile->path( 'utilities' );
        $content = '';

        foreach( $this->colors as $colour => $hex ) {
            $content .= '$colour--light-' . "{$colour}: " . $this->adjustBrightness( $hex, 100 ) . ";\n";
            $content .= '$colour--' . "{$colour}: {$hex};\n";
            $content .= '$colour--dark-' . "{$colour}: " . $this->adjustBrightness( $hex, -100 ) . ";\n\n";
        }
        $content .= "\n";

        $configFile->content( $content );
        $this->files[] = $configFile;
    }

    /**
     * @return void
     */
    protected function columns()
    {
        $columnFile = new UtilityFile();
        $columnFile->filename( 'columns.pcss' );
        $columnFile->path( 'utilities/segments' );
        $content = '';

        $this->mediarize( function( $prefix ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(--" . trim( $prefix, '--' ) . ") {\n";
            }
            $content .= ".{$prefix}col\:full-width {\n";
            $content .= "\tlost-column: 1/1;\n";
            $content .= "}\n";
            $maxColumns = [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ];
            while( $maxColumns ) {
                $count = array_shift( $maxColumns );
                for( $x = 1; $x < $count; $x++ ) {
                    $content .= ".{$prefix}col\:" . $x . "-of-" . $count . " {\n";
                    $content .= "\tlost-column: {$x}/{$count};\n";
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
     * @return array
     */
    public function generateFiles() : array
    {
        $this->colors();
        $this->columns();
        $this->configs();
        return $this->files;
    }
}
