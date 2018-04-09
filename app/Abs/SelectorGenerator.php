<?php

namespace Ensphere\Gnaw\Abs;

use Ensphere\Gnaw\Contracts\GnawFile;
use Ensphere\Gnaw\Generators\Generator;

abstract class SelectorGenerator implements Generator
{

    /**
     * @return GnawFile
     */
    abstract public function generate() : GnawFile;

}
