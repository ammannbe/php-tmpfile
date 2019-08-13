<?php

namespace TmpFile\Tests;

use TmpFile\Folder;
use PHPUnit\Framework\TestCase;

/**
 * Tests for temporary folders
 */
class FolderTest extends TestCase
{
    public function name()
    {
        return 'test';
    }

    public function path()
    {
        return '/test';
    }

    /**
     * @test
     */
    public function canCreateFolder()
    {
        $folder = new Folder();
        $this->assertTrue($folder->exists());
        return $folder;
    }

    /**
     * @test
     */
    public function canCreateFolderWithName()
    {
        $folder = new Folder('test');
        $this->assertTrue($folder->exists());
    }

    /**
     * @test
     */
    public function cannotCreateFolderWithName()
    {
        $this->expectException(\Exception::class);
        new Folder('/this-is-a-very-long-fake-path-which-should-not-exists/test');
    }

    /**
     * @test
     */
    public function canCreateFolderWithPath()
    {
        $folder = new Folder(null, '/tmp');
        $this->assertTrue($folder->exists());
    }

    /**
     * @test
     */
    public function cannotCreateFolderWithPath()
    {
        $this->expectException(\Exception::class);
        new Folder(null, '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @test
     */
    public function canCreateFolderWithNameAndPath()
    {
        $folder = new Folder('test', '/tmp');
        $this->assertTrue($folder->exists());
    }

    /**
     * @test
     */
    public function cannotCreateFolderWithNameAndPath()
    {
        $this->expectException(\Exception::class);
        new Folder('test', '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @test
     */
    public function canConvertPathToString()
    {
        $folder = new Folder();
        $this->assertEquals($folder->getPath(), (string) $folder);
    }
}
