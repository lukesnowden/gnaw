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
            $content .= "\tlost-column: 1/1;\n";
            $content .= "}\n";
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
     * @return array
     */
    public function generateFiles() : array
    {
        $this->colors();
        $this->columns();
        $this->spacing();
        $this->helpers();
        return $this->files;
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
