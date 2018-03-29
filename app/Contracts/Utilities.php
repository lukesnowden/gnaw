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
        });

        $colorFile->content( $content );
        $this->files[] = $colorFile;
    }

    /**
     * @param $callback
     */
    protected function mediarize( $callback )
    {
        foreach( [ '' ] + $this->medias as $media ) {
            $callback( preg_replace( "/^--$/", "", "{$media}--" ) );
        }
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
     * @return array
     */
    public function generateFiles() : array
    {
        $this->colors();
        $this->configs();
        return $this->files;
    }
}
