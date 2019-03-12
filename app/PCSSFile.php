<?php

namespace LukeSnowden\Gnaw;

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

    /**
     * @return mixed
     */
    public function replace();

}
