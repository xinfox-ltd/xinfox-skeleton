<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Auth\Infrastructure\Persistence\ThinkPHP;

use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use XinFox\Module\Auth\Domain\Token;

class TokenRepository implements \XinFox\Module\Auth\Domain\TokenRepository
{
    public function save(Token $token)
    {
        if ($this->findFirstByUserId($token->getUserId())) {
            \XinFox\Model\Token::update(
                [
                    'token_id' => $token->getId(),
                    'created_at' => time()
                ],
                ['user_id' => $token->getUserId()]
            );
        } else {
            \XinFox\Model\Token::create(
                [
                    'user_id' => $token->getUserId(),
                    'token_id' => $token->getId(),
                    'created_at' => time()
                ]
            );
        }
    }

    public function findFirstByUserId(int $userId): ?Token
    {
        try {
            $token = \XinFox\Model\Token::where("user_id", $userId)->findOrFail();
            return new Token($token->token_id, $token->user_id);
        } catch (DataNotFoundException | ModelNotFoundException | DbException $e) {
            return null;
        }
    }
}