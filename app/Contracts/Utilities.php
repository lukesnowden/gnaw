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
    protected function colours()
    {
        $colorFile = new UtilityFile();

        foreach( $this->colorTypes as $type ) {
            foreach( $this->colors as $colour => $hex ) {
                $this->return .= '.' . $type . '\:light-' . $colour . " {\n";
                $this->return .= "\t{$type}: " . '$colour--light-' . "{$colour};\n";
                $this->return .= "}\n";
                $this->return .= '.' . $type . '\:' . $colour . " {\n";
                $this->return .= "\t{$type}: " . '$colour--' . "{$colour};\n";
                $this->return .= "}\n";
                $this->return .= '.' . $type . '\:dark-' . $colour . " {\n";
                $this->return .= "\t{$type}: " . '$colour--dark-' . "{$colour};\n";
                $this->return .= "}\n";
            }
        }
        foreach( $this->colors as $colour => $hex ) {
            $this->config .= '$colour--light-' . "{$colour}: " . $this->adjustBrightness( $hex, 100 ) . ";\n";
            $this->config .= '$colour--' . "{$colour}: {$hex};\n";
            $this->config .= '$colour--dark-' . "{$colour}: " . $this->adjustBrightness( $hex, -100 ) . ";\n\n";
        }
        $this->config .= "\n";
    }

    /**
     * @return array
     */
    public function generateFiles() : array
    {
        return $this->files;
    }
}
