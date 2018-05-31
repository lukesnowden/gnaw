<?php

namespace Ensphere\Gnaw\Generators\Base;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Color;
use Ensphere\Gnaw\Traits\Media;

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
