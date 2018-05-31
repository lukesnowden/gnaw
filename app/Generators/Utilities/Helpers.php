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
            $content .= ".{$prefix}text-align\:left { text-align:left; }\n";
            $content .= ".{$prefix}text-align\:center { text-align:center; }\n";
            $content .= ".{$prefix}text-align\:right { text-align:right; }\n";
            $content .= ".{$prefix}full-width { width:100%; max-width:100%; }\n";
            $content .= ".{$prefix}not-a-list { list-style: none; margin: 0; padding: 0; }\n";
            $content .= ".{$prefix}float\:left { float:left; }\n";
            $content .= ".{$prefix}float\:right { float:right; }\n";
            $content .= ".{$prefix}float\:none { float:none; }\n";
            $content .= ".{$prefix}display\:none { display:none; }\n";
            $content .= ".{$prefix}display\:block { display:block; }\n";
            $content .= ".{$prefix}display\:flex { display:flex; }\n";
            $content .= ".{$prefix}round { border-radius:100%; overflow: hidden; }\n";
            $content .= ".{$prefix}children\:central { display: flex; justify-content: center; flex-wrap: wrap; }\n";
            $content .= ".{$prefix}children\:central > * { display:block; }\n";
            $content .= ".{$prefix}children\:same-height { display: flex; }\n";
            $content .= ".{$prefix}children\:same-height > * { flex: 1 1 auto; }\n";
            $content .= ".{$prefix}children\:vertically-aligned { position:relative; }\n";
            $content .= ".{$prefix}children\:vertically-aligned > * { position:relative; top: 50%; transform: translateY(-50%); }\n";
            $content .= ".{$prefix}middle-child\:centered { display: flex; }";
            $content .= ".{$prefix}middle-child\:centered > *:nth-child(1) { flex: 1 1 100%; }";
            $content .= ".{$prefix}middle-child\:centered > *:nth-child(3) { flex: 1 1 100%; }";
            $content .= ".{$prefix}middle-child\:centered > *:nth-child(2) { flex: 0 0 auto; }";
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        return $file;

    }

}
