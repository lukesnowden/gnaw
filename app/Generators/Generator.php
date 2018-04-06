<?php

namespace Ensphere\Gnaw\Generators;

use Ensphere\Gnaw\Contracts\GnawFile;

interface Generator
{

    /**
     * @return GnawFile
     */
    public function generate(): GnawFile

}
