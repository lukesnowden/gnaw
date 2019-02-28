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

            $content .= ".{$prefix}border\:none { border:none; border-width:0; }\n";

            $content .= ".{$prefix}stick\:right\:middle { position: absolute; right: 0; top: 50%; transform: translateY(-50%); }\n";
            $content .= ".{$prefix}stick\:right\:top { position: absolute; right: 0; top: 0; }\n";
            $content .= ".{$prefix}stick\:right\:bottom { position: absolute; right: 0; bottom: 0; }\n";
            $content .= ".{$prefix}stick\:left\:middle { position: absolute; left: 0; top: 50%; transform: translateY(-50%); }\n";
            $content .= ".{$prefix}stick\:left\:top { position: absolute; left: 0; top: 0; }\n";
            $content .= ".{$prefix}stick\:left\:bottom { position: absolute; left: 0; bottom: 0; }\n";

            $content .= ".{$prefix}children\:central { display: flex; justify-content: center; flex-wrap: wrap; }\n";
            $content .= ".{$prefix}children\:central > * { display:block; }\n";
            $content .= ".{$prefix}children\:same-height { display: flex; }\n";
            $content .= ".{$prefix}children\:same-height > * { flex: 0 1 auto; }\n";
            $content .= ".{$prefix}children\:vertically-aligned { position:relative; }\n";
            $content .= ".{$prefix}children\:vertically-aligned > * { position:relative; top: 50%; transform: translateY(-50%); }\n";

            $content .= ".{$prefix}middle-child\:centered { display: flex; }";
            $content .= ".{$prefix}middle-child\:centered > *:nth-child(1) { flex: 1 1 100%; }";
            $content .= ".{$prefix}middle-child\:centered > *:nth-child(3) { flex: 1 1 100%; }";
            $content .= ".{$prefix}middle-child\:centered > *:nth-child(2) { flex: 0 0 auto; }";

            $content .= ".{$prefix}child\:vertically-aligned { display: block; position:relative; }";
            $content .= ".{$prefix}child\:vertically-aligned > * { position: absolute; top: 50%; transform: translateY(-50%); }";

            $content .= ".{$prefix}z-index\:low { z-index:1; }\n";
            $content .= ".{$prefix}z-index\:medium { z-index:10; }\n";
            $content .= ".{$prefix}z-index\:high { z-index:50; }\n";
            $content .= ".{$prefix}z-index\:higher { z-index:100; }\n";

            $content .= ".{$prefix}overflow\:hidden { overflow: hidden; }\n";
            $content .= ".{$prefix}overflow\:visible { overflow: visible; }\n";

            $content .= ".{$prefix}position\:absolute { position: absolute; }\n";
            $content .= ".{$prefix}position\:relative { position: relative; }\n";
            $content .= ".{$prefix}position\:static { position: static; }\n";

            $content .= ".{$prefix}font-weight\:normal { font-weight: normal; }\n";
            $content .= ".{$prefix}font-weight\:bold { font-weight: bold; }\n";
            $content .= ".{$prefix}text-align\:left { text-align:left; }\n";
            $content .= ".{$prefix}text-align\:center { text-align:center; }\n";
            $content .= ".{$prefix}text-align\:right { text-align:right; }\n";
            $content .= ".{$prefix}width\:full { width:100%; max-width:100%; }\n";
            $content .= ".{$prefix}width\:auto { width:auto; max-width:auto; }\n";
            $content .= ".{$prefix}not-a-list { list-style: none; margin: 0; padding: 0; }\n";
            $content .= ".{$prefix}float\:left { float:left; }\n";
            $content .= ".{$prefix}float\:right { float:right; }\n";
            $content .= ".{$prefix}float\:none { float:none; }\n";
            $content .= ".{$prefix}display\:none { display:none; }\n";
            $content .= ".{$prefix}display\:block { display:block; }\n";
            $content .= ".{$prefix}display\:flex { display:flex; }\n";
            $content .= ".{$prefix}display\:inline { display:inline; }\n";
            $content .= ".{$prefix}display\:inline-block { display:inline-block; }\n";
            $content .= ".{$prefix}round { border-radius:100%; overflow: hidden; }\n";

            $content .= ".{$prefix}font-style\:italic { font-style:italic; }\n";
            $content .= ".{$prefix}text-decoration\:underline { text-decoration:underline; }\n";
            $content .= ".{$prefix}full-width { width:100%; }\n";

            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        return $file;

    }

}
