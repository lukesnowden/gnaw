<?php

namespace Ensphere\Gnaw\Abs;

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
        $this->path = $path;
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

}
