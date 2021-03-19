<?php
/**
 * Token
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Provider\Component\Auth;

use XinFox\Auth\Token;
use XinFox\Auth\TokenProviderInterface;

class TokenProvider implements TokenProviderInterface
{
    public function delete($tokenId): void
    {
        // TODO: Implement delete() method.
    }

    public function save(Token $token)
    {
        // TODO: Implement save() method.
    }

    public function valid(string $tokenIdentify): bool
    {
        return true;
    }
}