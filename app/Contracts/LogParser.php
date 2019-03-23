<?php

namespace App\Contracts;

interface LogParser
{
    /**
     * @return mixed
     */
    public function parse(): \Generator;
}
