<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Auth\Application;

class CreateTokenRequest
{
    private string $tokenId;

    private int $userId;

    public function __construct(string $tokenId, int $userId)
    {
        $this->tokenId = $tokenId;
        $this->userId = $userId;
    }

    public function getTokenId(): string
    {
        return $this->tokenId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}