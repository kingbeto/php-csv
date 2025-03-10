<?php

namespace Wilgucki\PhpCsv\Tests;

use PHPUnit\Framework\TestCase;
use Wilgucki\PhpCsv\Writer;

class WriterTest extends TestCase
{
    /**
     * @var string
     */
    protected $filepath;

    /**
     * @var Writer
     */
    protected $writer;

    protected function setUp()
    {
        $this->filepath = tempnam(sys_get_temp_dir(), md5(uniqid().time()));
        $this->writer = new Writer;
    }

    protected function tearDown()
    {
        if (file_exists($this->filepath)) {
            unlink($this->filepath);
        }
        $this->writer->close();
    }

    public function test_create()
    {
        $csv = $this->writer->create($this->filepath);
        static::assertTrue($csv instanceof Writer);
    }

    public function test_write_line()
    {
        $this->writer->create($this->filepath);
        $result = $this->writer->writeLine(['aaa', 'bbb', 'ccc']);
        static::assertTrue(is_int($result));
    }

    public function test_write_all()
    {
        $data = [
            ['aaa', 'bbb', 'ccc'],
            [111, 222, 333],
        ];
        $this->writer->create($this->filepath);
        $this->writer->writeAll($data);
        $savedData = $this->writer->flush();
        static::assertContains('aaa,bbb,ccc', $savedData);
        static::assertContains('111,222,333', $savedData);
    }

    public function test_flush()
    {
        $data = [
            ['aaa', 'bbb', 'ccc'],
            [111, 222, 333],
        ];
        $this->writer->create($this->filepath);
        $this->writer->writeAll($data);
        $flushed = $this->writer->flush();
        static::assertEquals('aaa,bbb,ccc'.PHP_EOL.'111,222,333'.PHP_EOL, $flushed);
    }
}
