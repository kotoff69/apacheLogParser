<?php

namespace App\Log;

use App\Contracts\AccessServerLog;

class Line implements AccessServerLog
{
    /**
     * Default line pattern
     */
    const LINE_PATTERN = "/(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) (\".*?\") (\".*?\")/";

    /**
     * Log vars
     */
    protected $ip = null;
    protected $identity = null;
    protected $user = null;
    protected $datetime = null;
    protected $timeZone = null;
    protected $method = null;
    protected $path = null;
    protected $protocol = null;
    protected $status = null;
    protected $size = null;
    protected $referer = null;
    protected $agent = null;

    /**
     * AccessServerLog constructor.
     *
     * @param string $line Log raw line
     * @throws \Exception
     */
    public function __construct($line)
    {
        $this->parse($line);
    }

    /**
     * Get ip
     *
     * @return null|string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @return null|string
     */
    public function getIdentity(): ?string
    {
        return $this->identity;
    }

    /**
     * @return null|string
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->datetime;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timeZone;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return null|string
     */
    public function getReferer(): ?string
    {
        return $this->referer;
    }

    /**
     * @return null|string
     */
    public function getAgent(): ?string
    {
        return $this->agent;
    }

    /**
     * Parse line
     *
     * @param $line
     * @return mixed
     * @throws \Exception
     */
    protected function parse($line)
    {
        if (preg_match(self::LINE_PATTERN, $line, $result)) {
            $this->ip = $result[1];
            $this->identity = $this->prepareParameter($result[2]);
            $this->user = $this->prepareParameter($result[3]);
            $this->datetime = \DateTime::createFromFormat('H:i:s d/M/Y', $result[5] . ' ' . $result [4]);
            $this->timeZone = $result[6];
            $this->method = $result[7];
            $this->path = $result[8];
            $this->protocol = $result[9];
            $this->status = $result[10];
            $this->size = intval($result[11]);
            $this->referer = $this->prepareParameter(trim($result[12], '"'));
            $this->agent = $this->prepareParameter(trim($result[13], '"'));
        } else {
            throw new \Exception('Invalid line or pattern');
        }
    }

    /**
     * Prepare parameter value
     *
     * @param string $parameter Value
     * @return string
     */
    protected function prepareParameter($parameter)
    {
        if ($parameter == '' || $parameter == '-') {
            $parameter = null;
        }
        return $parameter;
    }
}
