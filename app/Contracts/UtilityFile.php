<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\PCSSFile;

class UtilityFile implements PCSSFile
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
        // TODO: Implement distribute() method.
    }
}
