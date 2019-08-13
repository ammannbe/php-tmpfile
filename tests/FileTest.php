<?php

namespace TmpFile\Tests;

use TmpFile\File;
use PHPUnit\Framework\TestCase;

/**
 * Tests for temporary files
 */
class FileTest extends TestCase
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
    public function canCreateFile()
    {
        $file = new File();
        $this->assertTrue($file->exists());
        return $file;
    }

    /**
     * @test
     */
    public function canCreateFileWithName()
    {
        $file = new File('test');
        $this->assertTrue($file->exists());
    }

    /**
     * @test
     */
    public function cannotCreateFileWithName()
    {
        $this->expectException(\Exception::class);
        new File('/this-is-a-very-long-fake-path-which-should-not-exists/test');
    }

    /**
     * @test
     */
    public function canCreateFileWithPath()
    {
        $file = new File(null, '/tmp');
        $this->assertTrue($file->exists());
    }

    /**
     * @test
     */
    public function cannotCreateFileWithPath()
    {
        $this->expectException(\Exception::class);
        new File(null, '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @test
     */
    public function canCreateFileWithNameAndPath()
    {
        $file = new File('test', '/tmp');
        $this->assertTrue($file->exists());
    }

    /**
     * @test
     */
    public function cannotCreateFileWithNameAndPath()
    {
        $this->expectException(\Exception::class);
        new File('test', '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @test
     */
    public function canConvertPathToString()
    {
        $file = new File();
        $this->assertEquals($file->getPath(), (string) $file);
    }

    /**
     * @test
     */
    public function canReadFromFile()
    {
        $file = new File();
        file_put_contents($file->getPath(), "Some test text");
        $this->expectOutputString('Some test text');
        print $file->read("Some test text");
    }

    /**
     * @test
     */
    public function cannotReadFromFile()
    {
        $file = new File();
        file_put_contents($file->getPath(), "Some test text");
        @unlink($file);
        $this->assertFalse($file->read());
    }

    /**
     * @test
     */
    public function canWriteDataToFile()
    {
        $file = new File();
        $file->write("Some test text");
        $this->expectOutputString('Some test text');
        print file_get_contents($file->getPath());
        return $file;
    }

    /**
     * @test
     */
    public function cannotWriteDataToFile()
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->write("Some test text"));
    }

    /**
     * @test
     * @depends canWriteDataToFile
     */
    public function canAppendDataToFile(File $file)
    {
        $file->append("\nSome other test text");
        $this->expectOutputString('Some test text'.PHP_EOL.'Some other test text');
        print file_get_contents($file->getPath());
        return $file;
    }

    /**
     * @test
     */
    public function cannotAppendDataToFile()
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->append("Some test text"));
    }

    /**
     * @test
     */
    public function canWriteArrayToFile()
    {
        $file = new File();
        $file->writeArray(['Some', 'test', 'text']);
        $this->expectOutputString('Some'.PHP_EOL.'test'.PHP_EOL.'text');
        print file_get_contents($file->getPath());
        return $file;
    }

    /**
     * @test
     */
    public function cannotWriteArrayToFile()
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->writeArray(['Some', 'test', 'text']));
    }

    /**
     * @test
     * @depends canWriteArrayToFile
     */
    public function canAppendArrayToFile(File $file)
    {
        $file->appendArray(['Some', 'other', 'test', 'text']);
        $this->expectOutputString('Some'.PHP_EOL.'test'.PHP_EOL.'text'.PHP_EOL.'Some'.PHP_EOL.'other'.PHP_EOL.'test'.PHP_EOL.'text');
        print file_get_contents($file->getPath());
        return $file;
    }

    /**
     * @test
     */
    public function cannotAppendArrayToFile()
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->appendArray(['Some', 'other', 'test', 'text']));
    }
}
