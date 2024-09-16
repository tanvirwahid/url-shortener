<?php

namespace App\Dtos;

class ShortUrlDto
{
    private string $originalUrl;
    private string $shortenedUrl;
    private bool $isPrivate = false;
    private $expiresAt;
    private int|null $createdBy = null;

    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl(string $originalUrl): ShortUrlDto
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    public function getShortenedUrl(): string
    {
        return $this->shortenedUrl;
    }

    public function setShortenedUrl(string $shortenedUrl): ShortUrlDto
    {
        $this->shortenedUrl = $shortenedUrl;

        return $this;
    }

    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): ShortUrlDto
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param mixed $expiresAt
     */
    public function setExpiresAt($expiresAt): ShortUrlDto
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): ShortUrlDto
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
