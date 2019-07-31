<?php

namespace TmpFile;

/**
 * Create Temporary Folders
 */
class Folder extends FS
{
    /**
     * Destroy object and delete it from the filesystem
     */
    public function __destruct()
    {
        system('rm -rf '.escapeshellarg($this->path).' &>/dev/null');
    }

    /**
     * Check if folder exists
     *
     * @return bool
     */
    public function exists()
    {
        return is_dir($this->path);
    }
}
