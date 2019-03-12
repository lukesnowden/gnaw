<?php

namespace LukeSnowden\Gnaw\Contracts;

use LukeSnowden\Gnaw\Abs\File;
use LukeSnowden\Gnaw\PCSSFile;

class GnawFile extends File implements PCSSFile
{

    /**
     * @var string
     */
    protected $disk = 'post-css';

    /**
     * @return mixed
     */
    public function isConfigFile()
    {
        return false;
    }

}
