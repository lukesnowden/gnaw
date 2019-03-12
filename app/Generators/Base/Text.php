<?php

namespace LukeSnowden\Gnaw\Generators\Base;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Color;
use LukeSnowden\Gnaw\Traits\Media;

class Text extends SelectorGenerator implements Generator
{

    use Media, Color;

    /**
     * @var string
     */
    protected $route = __DIR__ . '/../../../resources/core-styles/base/';

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile
    {
        $file = new GnawFile();
        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            $content .= str_replace( [ '{$prefix}' ], [ $prefix ], file_get_contents( "{$this->route}text--heading.gnaw" ) );
            if( $prefix ) {
                $content .= "}\n";
            }
        });
        $content .= file_get_contents( "{$this->route}text.gnaw" );
        $file->content( $content );
        return $file;
    }
}
