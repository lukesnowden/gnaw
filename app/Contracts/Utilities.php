<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Generators\Utilities\Menus;
use Ensphere\Gnaw\Generators\Utilities\Shadows;
use Ensphere\Gnaw\PCSSBuilder;
use Ensphere\Gnaw\Generators\Utilities\Buttons;
use Ensphere\Gnaw\Generators\Utilities\Colors;
use Ensphere\Gnaw\Generators\Utilities\Columns;
use Ensphere\Gnaw\Generators\Utilities\FontSizes;
use Ensphere\Gnaw\Generators\Utilities\Helpers;
use Ensphere\Gnaw\Generators\Utilities\Spacing;
use Ensphere\Gnaw\Generators\Utilities\BorderRadius;

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
        Shadows::class
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
