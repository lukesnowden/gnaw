<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Abs\File;
use Ensphere\Gnaw\PCSSFile;

class UtilityFile extends File implements PCSSFile
{


    /**
     * @return mixed
     */
    public function isConfigFile()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function distribute()
    {
        dd($this);
    }
}
