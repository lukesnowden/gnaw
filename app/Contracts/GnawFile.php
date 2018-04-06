<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Abs\File;
use Ensphere\Gnaw\PCSSFile;

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
