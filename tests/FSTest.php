<?php

namespace TmpFile\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Some methods to test temporary files/folders
 */
abstract class FSTest extends TestCase
{
    /**
     * Get the file name
     *
     * @return string
     */
    public function name(): string
    {
        return 'test';
    }

    /**
     * Get the file path
     *
     * @return string
     */
    public function path(): string
    {
        return '/test';
    }
}
