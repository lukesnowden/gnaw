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
     *
     */
    protected function colors()
    {
        $colorFile = new UtilityFile();
        $colorFile->filename( 'colors.pcss' );
        $colorFile->path( 'utilities' );

        $content = '';
        foreach( $this->colorTypes as $type ) {
            foreach( $this->colors as $colour => $hex ) {
                $content .= '.' . $type . '\:light-' . $colour . " {\n";
                $content .= "\t{$type}: " . '$colour--light-' . "{$colour};\n";
                $content .= "}\n";
                $content .= '.' . $type . '\:' . $colour . " {\n";
                $content .= "\t{$type}: " . '$colour--' . "{$colour};\n";
                $content .= "}\n";
                $content .= '.' . $type . '\:dark-' . $colour . " {\n";
                $content .= "\t{$type}: " . '$colour--dark-' . "{$colour};\n";
                $content .= "}\n";
            }
        }

        $colorFile->content( $content );
        $this->files[] = $colorFile;

        //foreach( $this->colors as $colour => $hex ) {
        //    $this->config .= '$colour--light-' . "{$colour}: " . $this->adjustBrightness( $hex, 100 ) . ";\n";
        //    $this->config .= '$colour--' . "{$colour}: {$hex};\n";
        //    $this->config .= '$colour--dark-' . "{$colour}: " . $this->adjustBrightness( $hex, -100 ) . ";\n\n";
        //}
        //$this->config .= "\n";
    }

    /**
     * @return array
     */
    public function generateFiles() : array
    {
        $this->colors();
        return $this->files;
    }
}
