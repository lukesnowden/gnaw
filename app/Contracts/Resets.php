<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Generators\Resets\Normalise;
use Ensphere\Gnaw\Generators\Resets\Reset;
use Ensphere\Gnaw\PCSSBuilder;

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
