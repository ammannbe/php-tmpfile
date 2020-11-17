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
     * @param  string|null  $name  Folder name
     * @param  string|null  $path  Temporary path
     * @return void
     */
    public function __construct(string $name = null, string $path = null)
    {
        if (!$name) {
            $name = time();
        }

        $path = $path ?? sys_get_temp_dir();
        $command = "mktemp -p {$path} {$name}.XXXXXX";
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
        @unlink($this->path);
    }

    /**
     * Check if file exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return is_file($this->path);
    }

    /**
     * Get the file content
     *
     * @return string
     */
    public function read(): string
    {
        if ($this->exists()) {
            return file_get_contents($this->path) ?: '';
        }

        return '';
    }

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
    public function write($data, bool $overwrite = true): bool
    {
        if (is_array($data)) {
            // "\n" must be in double quotation marks to create a correct line wrap
            $data = implode("\n", $data);
        }

        $flags = $overwrite ? 0 : FILE_APPEND;
        if ($this->exists() && file_put_contents($this->path, $data, $flags) !== false) {
            return true;
        }

        return false;
    }
}
