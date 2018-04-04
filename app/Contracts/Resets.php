<?php


namespace Ensphere\Gnaw\Contracts;


use Ensphere\Gnaw\PCSSBuilder;

class Resets implements PCSSBuilder
{

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var string
     */
    protected $route = __DIR__ . '/../../resources/pcss/resets/';

    /**
     * @return array
     */
    public function generateFiles(): array
    {
        $this->files[] = $this->resetFile();
        $this->files[] = $this->normalizeFile();
        return $this->files;
    }

    /**
     * @return GnawFile
     */
    protected function resetFile()
    {
        $file = new GnawFile();
        $file->filename( 'reset.pcss' );
        $file->path( 'resets' );
        $file->content( file_get_contents( "{$this->route}reset.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function normalizeFile()
    {
        $file = new GnawFile();
        $file->filename( 'normalize.pcss' );
        $file->path( 'resets' );
        $file->content( file_get_contents( "{$this->route}normalize.pcss" ) );
        return $file;
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        return [

        ];
    }

}
