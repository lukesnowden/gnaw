<?php

namespace Ensphere\Gnaw\Abs;

use Illuminate\Support\Facades\Storage;

abstract class File
{

    /**
     * @var string
     */
    protected $filename = '';

    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $content = '';

    /**
     * @var string
     */
    protected $disk = 'local';

    /**
     * @param null|string $filename
     * @return string
     */
    final public function filename( $filename = null )
    {
        if( is_null( $filename ) ) {
            return $this->filename;
        }
        $this->filename = $filename;
    }

    /**
     * @param null|string $path
     * @return mixed
     */
    final public function path( $path = null )
    {
        if( is_null( $path ) ) {
            return $this->path;
        }
        $this->path = trim( $path, '/' );
    }

    /**
     * @param null $content
     * @return string
     */
    final public function content( $content = null )
    {
        if( is_null( $content ) ) {
            return $this->content;
        }
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function distribute()
    {
        Storage::disk( $this->disk )->put( "{$this->path}/{$this->filename}", $this->content );
    }

    /**
     * @return $void
     */
    public function replace( $replacements = [] )
    {
        foreach( $replacements as $variable => $replacment ) {
            $this->content = preg_replace( "#" . preg_quote( $variable, "#" ) . "(;|\s|\))#", $replacment . "$1", $this->content );
        }
    }

}
