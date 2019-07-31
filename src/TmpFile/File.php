<?php

namespace TmpFile;

/**
 * Create Temporary Files
 */
class File extends FS
{
    /**
     * Destroy object and delete it from the filesystem
     */
    public function __destruct()
    {
        @unlink($this->path);
    }

    /**
     * Check if file exists
     *
     * @return bool
     */
    public function exists() : bool
    {
        return is_file($this->path);
    }

    /**
     * Get the file content
     *
     * @return string
     */
    public function read() : string
    {
        if ($this->exists()) {
            return file_get_contents($this->path);
        }
    }

    /**
     * Write/Append content to the file
     *
     * @param mixed $data Content to write
     * @param int $flags = FILE_APPEND Flags for file_put_contents
     * @return int|false
     */
    public function write($data, int $flags = FILE_APPEND)
    {
        if ($this->exists()) {
            return file_put_contents($this->path, $data, $flags);
        } else {
            return false;
        }
    }

    /**
     * Write/Append array to the file
     *
     * Write each array value to a new line
     *
     * @see File::write();
     * @param array $data Array to write
     * @param int $flags = FILE_APPEND Flags for file_put_contents
     * @return int|false
     */
    public function writeArray(array $data, int $flags = FILE_APPEND)
    {
        // "\n" muss in doppelten Anführungszeichen stehen, ansonsten stimmt der Umbruch nicht
        return $this->write(implode("\n", $data), $flags);
    }
}
