<?php

namespace TmpFile\Tests;

use TmpFile\File;

/**
 * Tests for temporary files
 */
class FileTest extends FSTest
{
    /**
     * @return void
     */
    public function testCanCreateFile(): void
    {
        $file = new File();
        $this->assertTrue($file->exists());
    }

    /**
     * @return void
     */
    public function testCanCreateFileWithName(): void
    {
        $file = new File('test');
        $this->assertTrue($file->exists());
    }

    /**
     * @return void
     */
    public function testCannotCreateFileWithName(): void
    {
        $this->expectException(\Exception::class);
        new File('/this-is-a-very-long-fake-path-which-should-not-exists/test');
    }

    /**
     * @return void
     */
    public function testCanCreateFileWithPath(): void
    {
        $file = new File(null, '/tmp');
        $this->assertTrue($file->exists());
    }

    /**
     * @return void
     */
    public function testCannotCreateFileWithPath(): void
    {
        $this->expectException(\Exception::class);
        new File(null, '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @return void
     */
    public function testCanCreateFileWithNameAndPath(): void
    {
        $file = new File('test', '/tmp');
        $this->assertTrue($file->exists());
    }

    /**
     * @return void
     */
    public function testCannotCreateFileWithNameAndPath(): void
    {
        $this->expectException(\Exception::class);
        new File('test', '/this-is-a-very-long-fake-path-which-should-not-exists');
    }

    /**
     * @return void
     */
    public function testCanConvertPathToString(): void
    {
        $file = new File();
        $this->assertEquals($file->getPath(), (string) $file);
    }

    /**
     * @return void
     */
    public function testCanReadFromFile(): void
    {
        $file = new File();
        file_put_contents($file->getPath(), "Some test text");
        $this->expectOutputString('Some test text');
        print($file->read());
    }

    /**
     * @return void
     */
    public function testCannotReadFromFile(): void
    {
        $file = new File();
        file_put_contents($file->getPath(), "Some test text");
        @unlink($file);
        $this->assertEmpty($file->read());
    }

    /**
     * @return \TmpFile\File
     */
    public function testCanWriteDataToFile(): \TmpFile\File
    {
        $file = new File();
        $file->write("Some test text");
        $this->expectOutputString('Some test text');
        print(file_get_contents($file->getPath()));
        return $file;
    }

    /**
     * @return void
     */
    public function testCannotWriteDataToFile(): void
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->write("Some test text"));
    }

    /**
     * @depends testCanWriteDataToFile
     */
    public function testCanAppendDataToFile(File $file): void
    {
        $file->write("\nSome other test text", false);
        $this->expectOutputString('Some test text' . PHP_EOL . 'Some other test text');
        print(file_get_contents($file->getPath()));
    }

    /**
     * @return void
     */
    public function testCannotAppendDataToFile(): void
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->write("Some test text", false));
    }

    /**
     * @return \TmpFile\File
     */
    public function testCanWriteArrayToFile(): \TmpFile\File
    {
        $file = new File();
        $file->write(['Some', 'test', 'text']);
        $this->expectOutputString('Some' . PHP_EOL . 'test' . PHP_EOL . 'text');
        print(file_get_contents($file->getPath()));
        return $file;
    }

    /**
     * @return void
     */
    public function testCannotWriteArrayToFile(): void
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->write(['Some', 'test', 'text']));
    }

    /**
     * @depends testCanWriteArrayToFile
     */
    public function testCanAppendArrayToFile(File $file): void
    {
        $file->write(['', 'Some', 'other', 'test', 'text'], false);
        $this->expectOutputString('Some' . PHP_EOL . 'test' . PHP_EOL . 'text' . PHP_EOL . 'Some' . PHP_EOL . 'other' . PHP_EOL . 'test' . PHP_EOL . 'text');
        print(file_get_contents($file->getPath()));
    }

    /**
     * @return void
     */
    public function testCannotAppendArrayToFile(): void
    {
        $file = new File();
        @unlink($file);
        $this->assertFalse($file->write(['Some', 'other', 'test', 'text'], false));
    }
}
