<?php

namespace TmpFile\Contracts;

/**
 * Contract to create temporary files
 */
interface FileContract extends FSContract
{
    /**
     * Get the file content
     *
     * @return string
     */
    public function read(): string;

    /**
     * Write content to the file
     *
     * This method overwrites existing content in the file
     *
     * @see    file_put_contents()
     * @param  string|array<string>|resource  $data  Content to write
     * @param  bool  $overwrite  Overwrite instead of append
     * @return bool
     */
    public function write($data, bool $overwrite): bool;
}
