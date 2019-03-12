<?php

namespace LukeSnowden\Gnaw\Generators\Helpers;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Color;
use LukeSnowden\Gnaw\Traits\Media;

class ClearFix extends SelectorGenerator implements Generator
{

    use Media, Color;

    /**
     * @var string
     */
    protected $route = __DIR__ . '/../../../resources/core-styles/helpers/';

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile
    {
        $file = new GnawFile();
        $file->content( file_get_contents( "{$this->route}clearfix.gnaw" ) );
        return $file;
    }

}
