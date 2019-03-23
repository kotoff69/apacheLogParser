<?php

namespace App\Log;

use App\Contracts\LogParser;
use Illuminate\Support\Facades\Log;

class Parser implements LogParser
{
    /**
     * @var string Path to file
     */
    protected $filePath = null;

    /**
     * Parser constructor.
     *
     * @param string $filePath Full path to log file
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return \Generator
     */
    public function parse(): \Generator
    {
        $handler = fopen($this->filePath, 'r');
        try {
            while ($line = fgets($handler)) {
                try {
                    $parsedLine = new Line($line);
                    yield $parsedLine;
                } catch (\Throwable $e) {
                    Log::error($e);
                }
            }
        } finally {
            fclose($handler);
        }
    }
}
