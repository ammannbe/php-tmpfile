<?php

namespace TmpFile\Contracts;

/**
 * Contract to create temporary files and folders
 */
interface FSContract
{
    /**
     * Create new instance
     *
     * @param string $name = null
     * @param string $tmpPath = null
     * @return void
     */
    public function __construct(string $name = null, string $tmpPath = null);

    /**
     * Destroy object and delete it from the filesystem
     *
     * @return void
     */
    public function __destruct();

    /**
     * Get the object path, when converting the object to a string
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Destroy object and delete it from the filesystem
     *
     * @return void
     */
    public function delete(): void;

    /**
     * Check if object exists
     *
     * @return bool
     */
    public function exists(): bool;

    /**
     * Get the full object path
     *
     * @return string
     */
    public function getPath(): string;
}
