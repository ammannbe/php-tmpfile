<?php

namespace TmpFile\Tests;

use TmpFile\Folder;

/**
 * Tests for temporary folders
 */
class FolderTest extends FSTest
{
    /**
     * @return void
     */
    public function testCanCreateFolder(): void
    {
        $folder = new Folder();
        $this->assertTrue($folder->exists());
    }

    /**
     * @return void
     */
    public function testCanCreateFolderWithName(): void
    {
        $folder = new Folder('test');
        $this->assertTrue($folder->exists());
    }

    /**
     * @return void
     */
    public function testCannotCreateFolderWithName(): void
    {
        $this->expectException(\Exception::class);
        new Folder('/this-is-a-very-long-fake-path-which-should-not-exists/test');
    }

    /**
     * @return void
     */
    public function testCanCreateFolderWithPath(): void
    {
        $folder = new Folder(null, '/tmp');
        $this->assertTrue($folder->exists());
    }

    /**
     * @return void
     */
    public function testCannotCreateFolderWithPath(): void
    {
        $this->expectException(\Exception::class);
        new Folder(null, '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @return void
     */
    public function testCanCreateFolderWithNameAndPath(): void
    {
        $folder = new Folder('test', '/tmp');
        $this->assertTrue($folder->exists());
    }

    /**
     * @return void
     */
    public function testCannotCreateFolderWithNameAndPath(): void
    {
        $this->expectException(\Exception::class);
        new Folder('test', '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @return void
     */
    public function testCanConvertPathToString(): void
    {
        $folder = new Folder();
        $this->assertEquals($folder->getPath(), (string) $folder);
    }
}
