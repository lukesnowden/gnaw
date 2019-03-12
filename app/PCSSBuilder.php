<?php

namespace LukeSnowden\Gnaw;

interface PCSSBuilder
{

    /**
     * @return array
     */
    public function generateFiles() : array;

    /**
     * @return array
     */
    public function getReplacements() : array;

}
