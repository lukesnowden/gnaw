<?php

namespace Ensphere\Gnaw\Generators\Utilities;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Media;

class Helpers extends SelectorGenerator implements Generator
{

    use Media;

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile
    {

        $file = new GnawFile();
        $content = '';

        $this->mediarize( function( $prefix, $size ) use( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            $content .= ".{$prefix}full-width { width:100%; max-width:100%; }\n";
            $content .= ".{$prefix}not-a-list { list-style: none; margin: 0; padding: 0; }\n";
            $content .= ".{$prefix}float\:left { float:left; }\n";
            $content .= ".{$prefix}float\:right { float:right; }\n";
            $content .= ".{$prefix}float\:none { float:none; }\n";
            $content .= ".{$prefix}round { border-radius:100%; overflow: hidden; }\n";
            $content .= ".{$prefix}children\:same-height { display: flex; }\n";
            $content .= ".{$prefix}children\:same-height > * { flex: 1 1 auto; }\n";
            $content .= ".{$prefix}child\:vertically-aligned { position:relative; }\n";
            $content .= ".{$prefix}child\:vertically-aligned > * { position:relative; top: 50%; transform: translateY(-50%); }\n";
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        return $file;

    }

}
