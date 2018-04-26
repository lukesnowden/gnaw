<?php

namespace Ensphere\Gnaw\Generators\Utilities;

use Ensphere\Gnaw\Abs\SelectorGenerator;
use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;
use Ensphere\Gnaw\Traits\Media;

class Menus extends SelectorGenerator implements Generator
{

    use Media;

    /**
     * @var array
     */
    protected $directions = [
        'vertical',
        'horizontal'
    ];

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile
    {
        $file = new GnawFile();
        $content = '';

        $this->mediarize( function( $prefix, $size ) use ( &$content ) {
            if( $prefix ) {
                $content .= "@media(min-width: {$size}px) {\n";
            }
            foreach( $this->directions as $direction ) {
                foreach( config( 'gnaw.spacing' ) as $spacingName => $spacingValue ) {
                    $content .= ".{$prefix}menu\:{$direction}\:{$spacingName} {\n";

                    $content .= "},\n";
                }
            }
            if( $prefix ) {
                $content .= "}\n";
            }
        });

        $file->content( $content );
        return $file;
    }

}
