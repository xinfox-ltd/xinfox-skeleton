<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Auth\Domain;

interface TokenRepository
{
    public function save(Token $token);

    public function findFirstByUserId(int $userId): ?Token;
}