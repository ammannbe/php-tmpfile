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
     * @return string|false
     */
    public function read();

    /**
     * Write content to the file
     * 
     * This method overwrites existing content in the file
     *
     * @see write_put_contents()
     * @param mixed $data Content to write
     * @return bool
     */
    public function write($data) : bool;

    /**
     * Write array to the file
     *
     * Write each array value to a new line
     *
     * @see File::write();
     * @see write_put_contents()
     * @param array $data Array to write
     * @return bool
     */
    public function writeArray(array $data) : bool;

    /**
     * Append content to the file
     * 
     * This method will not overwrite any existing content in the file
     *
     * @see write_put_contents()
     * @param mixed $data Content to write
     * @return bool
     */
    public function append($data) : bool;

    /**
     * Append array to the file
     *
     * Write each array value to a new line
     *
     * @see File::append();
     * @see write_put_contents()
     * @param array $data Array to write
     * @return bool
     */
    public function appendArray(array $data) : bool;
}
