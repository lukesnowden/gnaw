<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Generators\Utilities\Menus;
use Ensphere\Gnaw\PCSSBuilder;
use Ensphere\Gnaw\Generators\Utilities\Buttons;
use Ensphere\Gnaw\Generators\Utilities\Colors;
use Ensphere\Gnaw\Generators\Utilities\Columns;
use Ensphere\Gnaw\Generators\Utilities\FontSizes;
use Ensphere\Gnaw\Generators\Utilities\Helpers;
use Ensphere\Gnaw\Generators\Utilities\Spacing;

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
        Colors::class,
        Columns::class,
        FontSizes::class,
        Helpers::class,
        Spacing::class,
        Buttons::class,
        Menus::class
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
        foreach( config( 'gnaw.colors' ) as $color => $shades ) {
            $replacements["\$color--{$color}"] = $shades['default'];
            $replacements["\$color--light-{$color}"] = $shades['light'];
            $replacements["\$color--dark-{$color}"] = $shades['dark'];
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
