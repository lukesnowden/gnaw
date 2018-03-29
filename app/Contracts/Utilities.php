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
                foreach( config( 'gnaw.colors' ) as $colour => $shades ) {
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

        foreach( config( 'gnaw.spacing' ) as $name => $value ) {
            $content .= '$space--' . "{$name}: {$value};\n";
        }
        $content .= "\n";

        foreach( config( 'gnaw.colors' ) as $colour => $shades ) {
            $content .= '$colour--light-' . "{$colour}: " . $shades['light'] . ";\n";
            $content .= '$colour--' . "{$colour}: " . $shades['default'] . ";\n";
            $content .= '$colour--dark-' . "{$colour}: " . $shades['dark'] . ";\n\n";
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
     * @return void
     */
    protected function helpers()
    {
        $helpersFile = new UtilityFile();
        $helpersFile->filename( 'helpers.pcss' );
        $helpersFile->path( 'utilities/segments' );
        $content = '';

        $this->mediarize( function( $prefix ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(--" . trim( $prefix, '--' ) . ") {\n";
            }
            $content .= ".{$prefix}full-width { width:100%; max-width:100%; }\n";
            $content .= ".{$prefix}not-a-list { list-style: none; margin: 0; padding: 0; }\n";
            $content .= ".{$prefix}float\:left { float:left; }\n";
            $content .= ".{$prefix}float\:right { float:right; }\n";
            $content .= ".{$prefix}children\:same-height { display: flex; > * { flex: 1 1 auto; } }\n";
            $content .= ".{$prefix}child\:vertically-aligned { position:relative; > * { position:relative; top: 50%; transform: translateY(-50%); } }\n";
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

        $spacingFile = new UtilityFile();
        $spacingFile->filename( 'spacing.pcss' );
        $spacingFile->path( 'utilities/segments' );
        $content = '';

        $this->mediarize( function( $prefix ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(--" . trim( $prefix, '--' ) . ") {\n";
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
     * @return array
     */
    public function generateFiles() : array
    {
        $this->colors();
        $this->columns();
        $this->spacing();
        $this->helpers();
        $this->configs();
        return $this->files;
    }
}
