<?php

namespace LukeSnowden\Gnaw\Generators\Base;

use LukeSnowden\Gnaw\Abs\SelectorGenerator;
use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;
use LukeSnowden\Gnaw\Traits\Color;
use LukeSnowden\Gnaw\Traits\Media;

class Forms extends SelectorGenerator implements Generator
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
        $file->content( file_get_contents( "{$this->route}forms.gnaw" ) );
        return $file;
    }
}
