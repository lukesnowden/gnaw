<?php


namespace Ensphere\Gnaw\Contracts;


use Ensphere\Gnaw\PCSSBuilder;

class Base implements PCSSBuilder
{

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var string
     */
    protected $route = __DIR__ . '/../../resources/pcss/base/';

    /**
     * @return array
     */
    public function generateFiles(): array
    {
        $this->files[] = $this->textFile();
        return $this->files;
    }

    /**
     * @return GnawFile
     */
    protected function textFile()
    {
        $file = new GnawFile();
        $file->filename( 'text.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}text.pcss" ) );
        return $file;
    }


}
