<?php

namespace TmpFile;

use TmpFile\Contracts\FolderContract;

/**
 * Create Temporary Folders
 */
class Folder extends FS implements FolderContract
{
    /**
     * Create new instance
     *
     * @param  string|null  $name  Folder name
     * @param  string|null  $path  Temporary path
     */
    public function __construct(string $name = null, string $path = null)
    {
        if (!$name) {
            $name = time();
        }

        $path = $path ?? sys_get_temp_dir();
        $command = "mktemp -d -p {$path} {$name}.XXXXXX";
        $this->path = trim(`{$command} 2>/dev/null`);

        if (!$this->exists()) {
            throw new \Exception("Could not create file '{$name}' in {$path}");
        }
    }

    /**
     * Destroy object and delete it from the filesystem
     *
     * @return void
     */
    public function __destruct()
    {
        system('rm -rf ' . escapeshellarg($this->path) . ' &>/dev/null');
    }

    /**
     * Check if folder exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return is_dir($this->path);
    }
}
