<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;
use XinFox\Module\Captcha\Application\CaptchaVerifyService;
use XinFox\Module\Captcha\Infrastructure\Persistence\ThinkPHP\CaptchaRepository;
use XinFox\Module\User\Application\Login\AccountLogin;
use XinFox\Module\User\Application\Login\PhoneLogin;
use XinFox\Module\User\Application\Login\WechatMiniProgramCodeLogin;
use XinFox\Module\User\Application\Login\WechatMiniProgramPhoneLogin;
use XinFox\Module\User\Infrastructure\Persistence\ThinkPHP\UserRepository;
use XinFox\Module\User\Infrastructure\Persistence\ThinkPHP\WechatMiniProgramSessionRepository;
use XinFox\Module\User\Infrastructure\Validator\LoginValidator;

class TokensController extends BaseController
{
    /**
     * 登录获取token
     * @Route("/v1/tokens", method="POST")
     */
    public function create(): Json
    {
        $data = $this->request->post();
        validate(LoginValidator::class)->check($data);

        switch ($data['mode']) {
            //账号密码登录
            case 'account':
                $service = new AccountLogin(
                    new UserRepository()
                );
                $user = $service->exec($data['account'], $data['passwd']);
                break;
            //手机验证码登录
            case 'phone_sms':
                $captchaVerify = new CaptchaVerifyService(
                    new CaptchaRepository($this->cache)
                );
                if (!$captchaVerify->exec($data['phone'], $$data['code'])) {
                    return error_response('验证码错误');
                }

                $service = new PhoneLogin(
                    new UserRepository()
                );
                $user = $service->exec($data['phone']);
                break;
            //微信小程序登录
            case 'wechat_mini_program_code':
                $service = new WechatMiniProgramCodeLogin(
                    new UserRepository(),
                    new WechatMiniProgramSessionRepository()
                );
                $user = $service->exec($data['code']);
                break;
            //TODO 微信小程序手机登录
//            case 'wechat_mini_program_phone':
//                $service = new WechatMiniProgramPhoneLogin();
//                $user = $service->exec($data['account'], $data['passwd']);
//                break;
            default:
                return error_response(sprintf('登录方式%s不存在', $data['mode']));
        }

        $token = $this->auth->login($user);

        return success_response(
            [
                'access_token' => (string)$token,
                'token_type' => 'Bearer',
                'expires_in' => $token->getExp(),
                'role' => 'admin',
            ]
        );
    }
}