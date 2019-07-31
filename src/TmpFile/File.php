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
     * Write content to the file
     * 
     * This method overwrites existing content in the file
     *
     * @see write_put_contents()
     * @param mixed $data Content to write
     * @return int|false
     */
    public function write($data)
    {
        if ($this->exists()) {
            return file_put_contents($this->path, $data);
        } else {
            return false;
        }
    }

    /**
     * Write array to the file
     *
     * Write each array value to a new line
     *
     * @see File::write();
     * @see write_put_contents()
     * @param array $data Array to write
     * @return int|false
     */
    public function writeArray(array $data)
    {
        // "\n" must be in double quotation marks to create a correct line wrap
        return $this->write(implode("\n", $data));
    }

    /**
     * Append content to the file
     * 
     * This method will not overwrite any existing content in the file
     *
     * @see write_put_contents()
     * @param mixed $data Content to write
     * @return int|false
     */
    public function append($data)
    {
        if ($this->exists()) {
            return file_put_contents($this->path, $data, FILE_APPEND);
        } else {
            return false;
        }
    }

    /**
     * Append array to the file
     *
     * Write each array value to a new line
     *
     * @see File::append();
     * @see write_put_contents()
     * @param array $data Array to write
     * @return int|false
     */
    public function appendArray(array $data)
    {
        // "\n" must be in double quotation marks to create a correct line wrap
        return $this->append(implode("\n", $data));
    }
}
