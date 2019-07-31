<?php

namespace TmpFile;

/**
 * Contract to create temporary files and folders
 */
interface Contract
{
    /**
     * Create new instance
     *
     * @param string $name
     */
    public function __construct(string $name);

    /**
     * Destroy object and delete it from the filesystem
     */
    public function __destruct();

    /**
     * Destroy object and delete it from the filesystem
     */
    public function delete();

    /**
     * Check if object exists
     *
     * @return bool
     */
    public function exists() : bool;

    /**
     * Get the full object path
     *
     * @return string
     */
    public function getPath() : string;
}
