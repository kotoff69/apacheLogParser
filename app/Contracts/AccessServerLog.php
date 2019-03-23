<?php

namespace App\Contracts;

interface AccessServerLog
{
    /**
     * Get ip
     *
     * @return null|string
     */
    public function getIp(): ?string;

    /**
     * @return null|string
     */
    public function getIdentity(): ?string;

    /**
     * @return null|string
     */
    public function getUser(): ?string;

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime;

    /**
     * @return string
     */
    public function getTimezone(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return string
     */
    public function getProtocol(): string;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @return int|null
     */
    public function getSize(): ?int;

    /**
     * @return null|string
     */
    public function getReferer(): ?string;

    /**
     * @return null|string
     */
    public function getAgent(): ?string;
}
