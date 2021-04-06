<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Auth\Infrastructure\Persistence\ThinkPHP;

use XinFox\Module\Auth\Domain\Token;

class TokenRepository implements \XinFox\Module\Auth\Domain\TokenRepository
{
    public function save(Token $token)
    {
        \XinFox\Model\Token::create(
            [
                'user_id' => $token->getUserId(),
                'token_id' => $token->getId(),
                'created_at' => time()
            ]
        );
    }

    public function findFirstByUserId(int $userId): Token
    {
        // TODO: Implement findFirstByUserId() method.
    }
}