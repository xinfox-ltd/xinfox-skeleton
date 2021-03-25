<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application\Login;

use GuzzleHttp\Exception\GuzzleException;
use XinFox\Module\User\Application\Exception\AccountOffException;
use XinFox\Module\User\Application\Exception\NotBindException;
use XinFox\Module\User\Domain\WechatMiniProgramSession;
use XinFox\Module\User\Domain\User;
use XinFox\Module\User\Domain\UserRepository;
use XinFox\Module\User\Domain\WechatMiniProgramSessionRepository;
use XinFox\Module\User\Infrastructure\Wechat\Client;

class WechatMiniProgramCodeLogin
{
    private UserRepository $userRepository;

    private WechatMiniProgramSessionRepository $miniProgramSessionRepository;

    public function __construct(
        UserRepository $userRepository,
        WechatMiniProgramSessionRepository $miniProgramSessionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->miniProgramSessionRepository = $miniProgramSessionRepository;
    }

    /**
     * @param string $code
     * @return User
     * @throws AccountOffException
     * @throws NotBindException
     * @throws GuzzleException
     */
    public function exec(string $code): User
    {
        $client = new Client();
        $code2Session = $client->miniProgram->jsCode2Session($code);

        $unionId = $code2Session->getUnionId();
        //优先使用unionId
        if (!empty($unionId)) {
            $user = $this->userRepository->findFirstByUnionId($unionId);
        } else {
            $user = $this->userRepository->findFirstByOpenId($code2Session->getOpenId());
        }

        $miniProgramSession = new WechatMiniProgramSession(
            $code2Session->getOpenId(),
            $code2Session->getSessionKey(),
            $code2Session->getUnionId()
        );

        $this->miniProgramSessionRepository->save($miniProgramSession);

        if (!$user) {
            throw new NotBindException($miniProgramSession, '小程序还没有绑定到账户');
        }

        if (!$user->isNormal()) {
            throw new AccountOffException();
        }

        $this->userRepository->save($user);

        return $user;
    }
}