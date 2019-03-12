<?php

namespace LukeSnowden\Gnaw\Abs;

use LukeSnowden\Gnaw\Contracts\GnawFile;
use LukeSnowden\Gnaw\Generators\Generator;

abstract class SelectorGenerator implements Generator
{

    /**
     * @return GnawFile
     */
    abstract public function generate() : GnawFile;

}
