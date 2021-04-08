<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Auth\Application;

use XinFox\Module\Auth\Domain\Token;
use XinFox\Module\Auth\Domain\TokenRepository;

class CreateTokenService
{
    private TokenRepository $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function exec(CreateTokenRequest $createTokenRequest): Token
    {
        $token = $this->tokenRepository->findFirstByUserId($createTokenRequest->getUserId());
        if ($token) {
            $token->update($createTokenRequest->getTokenId());
        } else {
            $token = Token::create(
                $createTokenRequest->getTokenId(),
                $createTokenRequest->getUserId()
            );
        }
        $this->tokenRepository->save($token);

        return $token;
    }
}