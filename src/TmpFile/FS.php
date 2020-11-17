<?php

namespace TmpFile;

use TmpFile\Contracts\FSContract;

/**
 * Base class to create temporary files and folders
 */
abstract class FS implements FSContract
{
    /**
     * The full object path
     *
     * @var string
     */
    protected $path;

    /**
     * Destroy object and delete it from the filesystem
     *
     * @return void
     */
    public function delete(): void
    {
        $this->__destruct();
    }

    /**
     * Get the full object path
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getPath();
    }

    /**
     * Get the full object path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
