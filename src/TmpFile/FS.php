<?php

namespace TmpFile;

/**
 * Base class to create temporary files and folders
 */
abstract class FS implements Contract
{
    /** @var string|null Should contain the full object path */
    protected $path;

    /**
     * Destroy object and delete it from the filesystem
     *
     * @return void
     */
    public function delete() : void
    {
        $this->__destruct();
    }

    /**
     * Get the object path, when converting the object to a string
     * 
     * @return string
     */
    public function __toString() : string
    {
        return $this->getPath();
    }

    /**
     * Get the full object path
     *
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }
}
