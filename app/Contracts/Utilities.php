<?php

namespace LukeSnowden\Gnaw\Contracts;

use LukeSnowden\Gnaw\Generators\Utilities\Menus;
use LukeSnowden\Gnaw\Generators\Utilities\Shadows;
use LukeSnowden\Gnaw\Generators\Utilities\Widths;
use LukeSnowden\Gnaw\PCSSBuilder;
use LukeSnowden\Gnaw\Generators\Utilities\Buttons;
use LukeSnowden\Gnaw\Generators\Utilities\Colors;
use LukeSnowden\Gnaw\Generators\Utilities\Columns;
use LukeSnowden\Gnaw\Generators\Utilities\FontSizes;
use LukeSnowden\Gnaw\Generators\Utilities\Helpers;
use LukeSnowden\Gnaw\Generators\Utilities\Spacing;
use LukeSnowden\Gnaw\Generators\Utilities\BorderRadius;

class Utilities implements PCSSBuilder
{


    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $generators = [
        Buttons::class,
        Colors::class,
        Columns::class,
        FontSizes::class,
        Helpers::class,
        Spacing::class,
        Menus::class,
        BorderRadius::class,
        Shadows::class,
        Widths::class
    ];

    /**
     * @return array
     */
    public function generateFiles() : array
    {
        foreach( $this->generators as $generator ) {
            $this->gnawFile( ( new $generator )->generate() );
        }
        return $this->files;
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        $replacements = [];
        foreach( config( 'gnaw.colors' ) as $color => $hexCode ) {
            $replacements["\$color--{$color}"] = $hexCode;
        }
        return $replacements;
    }

    /**
     * @param GnawFile $file
     */
    private function gnawFile( GnawFile $file )
    {
        $this->files[] = $file;
    }

}
