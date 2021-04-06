<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Auth\Domain;

class Token
{
    private string $id;

    private int $userId;

    public function __construct(string $id, int $userId)
    {
        $this->userId = $userId;
        $this->id = $id;
    }

    public static function create(string $tokenId, int $userId): Token
    {
        return new self($tokenId, $userId);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function update(string $id)
    {
        $this->id = $id;
    }
}
