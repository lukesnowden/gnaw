<?php

namespace Ensphere\Gnaw\Contracts;

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
     * @return array
     */
    public function generateFiles(): array
    {
        $this->files[] = $this->clearfixFile();
        return $this->files;
    }

    /**
     * @return GnawFile
     */
    protected function clearfixFile(): GnawFile
    {
        $file = new GnawFile();
        $file->content( file_get_contents( "{$this->route}clearfix.gnaw" ) );
        return $file;
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        return [];
    }
}
