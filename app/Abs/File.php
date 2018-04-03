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
     * @var array
     */
    private $replacements = [];

    /**
     * File constructor.
     */
    public function __construct()
    {
        $this->replacements = [
            '$heading--color' => gnaw_config( 'gnaw.text.color' ),
            '$font-size' => gnaw_config( 'gnaw.text.font-size' ) . 'px',
            '$heading--very-large-font-size' => gnaw_config( 'gnaw.text.headings.very-large.font-size' ) . 'px',
            '$heading--very-large-line-height' => gnaw_config( 'gnaw.text.headings.very-large.font-size' ) + ( ( gnaw_config( 'gnaw.text.headings.very-large.font-size' ) / 100 ) * gnaw_config( 'gnaw.text.line-height-percentage' ) ) . 'px',
            '$heading--large-font-size' => gnaw_config( 'gnaw.text.headings.large.font-size' ) . 'px',
            '$heading--large-line-height' => gnaw_config( 'gnaw.text.headings.large.font-size' ) + ( ( gnaw_config( 'gnaw.text.headings.large.font-size' ) / 100 ) * gnaw_config( 'gnaw.text.line-height-percentage' ) ) . 'px',
            '$heading--medium-font-size' => gnaw_config( 'gnaw.text.headings.medium.font-size' ) . 'px',
            '$heading--medium-line-height' => gnaw_config( 'gnaw.text.headings.medium.font-size' ) + ( ( gnaw_config( 'gnaw.text.headings.medium.font-size' ) / 100 ) * gnaw_config( 'gnaw.text.line-height-percentage' ) ) . 'px',
            '$heading--small-font-size' => gnaw_config( 'gnaw.text.headings.small.font-size' ) . 'px',
            '$heading--small-line-height' => gnaw_config( 'gnaw.text.headings.small.font-size' ) + ( ( gnaw_config( 'gnaw.text.headings.small.font-size' ) / 100 ) * gnaw_config( 'gnaw.text.line-height-percentage' ) ) . 'px',
            '$heading--very-small-font-size' => gnaw_config( 'gnaw.text.headings.very-small.font-size' ) . 'px',
            '$heading--very-small-line-height' => gnaw_config( 'gnaw.text.headings.very-small.font-size' ) + ( ( gnaw_config( 'gnaw.text.headings.very-small.font-size' ) / 100 ) * gnaw_config( 'gnaw.text.line-height-percentage' ) ) . 'px',
            '$heading--font-family' => gnaw_config( 'gnaw.text.font-family' ),
            '$heading--spacing' => gnaw_config( 'gnaw.text.headings.spacing' ) . 'px',
            '$anchor--color' => gnaw_config( 'gnaw.text.anchors.color' ),
            '$anchor--hover-color' => gnaw_config( 'gnaw.text.anchors.hover-color' ),
        ];
    }

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
    public function replace()
    {
        foreach( $this->replacements as $variable => $replacment ) {
            $this->content = preg_replace( "#" . preg_quote( $variable, "#" ) . "(;|\s|\))#", $replacment . "$1", $this->content );
        }
    }

}
