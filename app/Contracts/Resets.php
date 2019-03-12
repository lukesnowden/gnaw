<?php

namespace LukeSnowden\Gnaw\Contracts;

use LukeSnowden\Gnaw\Generators\Resets\Normalise;
use LukeSnowden\Gnaw\Generators\Resets\Reset;
use LukeSnowden\Gnaw\PCSSBuilder;

class Resets implements PCSSBuilder
{

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $generators = [
        Normalise::class,
        Reset::class
    ];

    /**
     * @return array
     */
    public function generateFiles(): array
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
        return [];
    }

    /**
     * @param GnawFile $file
     */
    private function gnawFile( GnawFile $file )
    {
        $this->files[] = $file;
    }

}
