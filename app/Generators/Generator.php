<?php

namespace LukeSnowden\Gnaw\Generators;

use LukeSnowden\Gnaw\Contracts\GnawFile;

interface Generator
{

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile;

}
