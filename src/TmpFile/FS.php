<?php

namespace TmpFile;

/**
 * Base class to create temporary files and folders
 */
abstract class FS implements Contract
{
    /**
     * System temp directory
     */
    protected $tmpDir;

    /**
     * The full object path
     */
    protected $path;

    /**
     * Create new instance
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->tmpDir = sys_get_temp_dir();

        if ($this instanceOf File) {
            $command = "mktemp -p {$this->tmpDir} {$name}.XXXXXX";
        } else {
            $command = "mktemp -d -p {$this->tmpDir} {$name}.XXXXXX";
        }
        $this->path = trim(`{$command}`);
    }

    /**
     * Destroy object and delete it from the filesystem
     */
    public function delete()
    {
        $this->__destruct();
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
