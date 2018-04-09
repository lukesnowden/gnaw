<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Generators\Helpers\ClearFix;
use Ensphere\Gnaw\PCSSBuilder;

class Helpers implements PCSSBuilder
{

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var string
     */
    protected $route = __DIR__ . '/../../resources/pcss/helpers/';

    /**
     * @var array
     */
    protected $generators = [
        ClearFix::class
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
