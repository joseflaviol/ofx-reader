<?php

namespace OFXReader\Tests;

use OFXReader\Exception\FileNotFoundException;
use OFXReader\Exception\IncorrectFileExtensionException;
use OFXReader\Reader;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestStatus\Notice;

class ReaderTest extends TestCase
{
    private Reader $reader;

    public function setUp(): void {}

    public function testItThrowsExceptionWhenFileFormatIsIncorrect()
    {
        $filePath = __DIR__ . "/../blabla.txt";

        $this->expectException(IncorrectFileExtensionException::class);

        Reader::read($filePath);
    }

    public function testItThrowsExceptionWhenFileDoesNotExists()
    {
        $filePath = __DIR__ . "/../blabla.ofx";

        $this->expectException(Notice::class);
        $this->expectException(FileNotFoundException::class);

        Reader::read($filePath);
    }
}
