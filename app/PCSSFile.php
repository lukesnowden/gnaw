<?php

namespace Ensphere\Gnaw;

interface PCSSFile
{

    /**
     * @return mixed
     */
    public function isConfigFile();

    /**
     * @return mixed
     */
    public function distribute();

}
