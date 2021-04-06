<?php
/**
 * Token
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Module\Auth\Infrastructure;

use XinFox\Auth\Token;
use XinFox\Auth\TokenProviderInterface;
use XinFox\Module\Auth\Application\CreateTokenRequest;
use XinFox\Module\Auth\Application\CreateTokenService;
use XinFox\Module\Auth\Infrastructure\Persistence\ThinkPHP\TokenRepository;

class TokenProvider implements TokenProviderInterface
{
    public function delete($tokenId): void
    {
        // TODO: Implement delete() method.
    }

    public function save(Token $token)
    {
        $request = new CreateTokenRequest($token->getJti(), 1);
        $service = new CreateTokenService(
            new TokenRepository()
        );
        $service->exec($request);
    }

    public function valid(string $tokenIdentify): bool
    {
        return true;
    }
}