<?php

namespace Wilgucki\PhpCsv;

/**
 * Class AbstractCsv
 */
abstract class AbstractCsv
{
    protected string $delimiter;

    protected string $enclosure;

    protected string $escape;

    protected ?string $encodingFrom;

    protected ?string $encodingTo;

    /** @var resource|null */
    protected $handle;

    /**
     * @param  string  $delimiter  @link http://php.net/manual/en/function.fgetcsv.php
     * @param  string  $enclosure  @link http://php.net/manual/en/function.fgetcsv.php
     * @param  string  $escape  @link http://php.net/manual/en/function.fgetcsv.php
     * @param  string|null  $encodingFrom  Input encoding
     * @param  string|null  $encodingTo  Output encoding
     */
    public function __construct(
        string $delimiter = ',',
        string $enclosure = '"',
        string $escape = '\\',
        ?string $encodingFrom = null,
        ?string $encodingTo = null
    ) {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
        $this->encodingFrom = $encodingFrom;
        $this->encodingTo = $encodingTo;
    }

    /**
     * Open CSV file
     *
     * @param  string  $file  File name with path to open
     * @param  string  $mode  @link http://php.net/manual/en/function.fopen.php
     * @return $this
     */
    public function open(string $file, string $mode): self
    {
        $this->handle = fopen($file, $mode);

        return $this;
    }

    /**
     * Close file pointer
     */
    public function close(): void
    {
        fclose($this->handle);
    }
}
