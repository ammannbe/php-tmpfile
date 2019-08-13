<?php

namespace TmpFile;

/**
 * Create Temporary Folders
 */
class Folder extends FS
{
    /**
     * Create new instance
     *
     * @param string $name = null
     * @param string $tmpPath = null
     */
    public function __construct(string $name = null, string $tmpPath = null)
    {
        if (! $name) { $name = time(); }
        $tmpPath = $tmpPath ?? sys_get_temp_dir();
        $command = "mktemp -d -p {$tmpPath} {$name}.XXXXXX";
        $this->path = trim(`{$command} 2>/dev/null`);
    }

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
    public function exists() : bool
    {
        return is_dir($this->path);
    }
}
