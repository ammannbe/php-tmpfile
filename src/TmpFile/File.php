<?php

namespace TmpFile;

use TmpFile\Contracts\FileContract;

/**
 * Create Temporary Files
 */
class File extends FS implements FileContract
{
    /**
     * Create new instance
     *
     * @param string $name = null
     * @param string $tmpPath = null
     * @return void
     */
    public function __construct(string $name = null, string $tmpPath = null)
    {
        if (! $name) { $name = time(); }
        $tmpPath = $tmpPath ?? sys_get_temp_dir();
        $command = "mktemp -p {$tmpPath} {$name}.XXXXXX";
        $this->path = trim(`{$command} 2>/dev/null`);
        if (! $this->exists()) {
            throw new \Exception("Could not create file '{$name}' in {$tmpPath}");
        }
    }

    /**
     * Destroy object and delete it from the filesystem
     *
     * @return void
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
     * @return string|false
     */
    public function read()
    {
        if ($this->exists()) {
            return file_get_contents($this->path);
        }
        return false;
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
        return file_put_contents($this->path, $data);
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
        return file_put_contents($this->path, $data, FILE_APPEND);
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
        return $this->append("\n" . implode("\n", $data));
    }
}
