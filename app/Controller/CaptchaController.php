<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Controller;

use Psr\SimpleCache\InvalidArgumentException;
use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;
use XinFox\Module\Captcha\Application\CaptchaVerifyService;
use XinFox\Module\Captcha\Application\CreateCaptchaService;
use XinFox\Module\Captcha\Infrastructure\Generator\ImageCaptchaGenerator;
use XinFox\Module\Captcha\Infrastructure\Generator\SmsCaptchaGenerator;
use XinFox\Module\Captcha\Infrastructure\Persistence\ThinkPHP\CaptchaRepository;
use XinFox\Module\Captcha\Infrastructure\Sms\Scene\UserRegisterScene;
use XinFox\Module\Captcha\Infrastructure\Validator\CaptchaValidator;
use XinFox\Module\Captcha\Infrastructure\Validator\CaptchaVerifyValidator;
use XinFox\Sms\XinFoxSms;

/**
 * 验证码控制器
 * Class CaptchaController
 * @package XinFox\Controller
 */
class CaptchaController extends BaseController
{
    /**
     * 创建验证码
     * @Route("/v1/captcha", method="POST")
     */
    public function create(): Json
    {
        $data = $this->request->post();
        //校验数据
        validate(CaptchaValidator::class)->check($data);

        switch ($data['type']) {
            case 'sms':
                if (empty($data['scene'])) {
                    return error_response('参数[scene]不能为空');
                }
                //短信场景
                switch ($data['scene']) {
                    case 'register':
                        $scene = new UserRegisterScene($data['phone']);
                        break;
//                    case 'login':
//                        $scene = new UserLoginScene($data['phone']);
//                        break;
//                    case 'reset_pwd':
//                        $scene = new UserRestPWDScene($data['phone']);
//                        break;
//                    case 'withdrawal':
//                        $scene = new UserWithdrawalScene($this->visitor);
//                        break;
                    default:
                        return error_response('暂不支持 scene [' . $data['scene']);
                }

                $drive = new SmsCaptchaGenerator($this->app->get(XinFoxSms::class), $scene);
                break;
            case "image":
                $drive = new ImageCaptchaGenerator();
                break;
            default:
                return error_response('暂不支持 type [' . $data['type']);
        }

        try {
            $captchaService = new CreateCaptchaService(new CaptchaRepository($this->cache), $drive);
            // 创建验证码
            $captcha = $captchaService->exec(600);
            $returnData = [
                'id' => $captcha->getId(),
                'type' => $captcha->getType(),
                'src' => $captcha->getSrc()
            ];

            //调试模式下返回code，方便测试
            if ($this->app->isDebug()) {
                $returnData['code'] = $captcha->getCode();
            }

            return success_response($returnData);
        } catch (\Exception | InvalidArgumentException $exception) {
            return error_response($exception->getMessage());
        }
    }

    /**
     * 验证码校验
     * @Route("/captcha/verify", method="POST")
     */
    public function verify(): Json
    {
        $data = $this->request->post();
        validate(CaptchaVerifyValidator::class)->check($data);

        $captchaVerify = new CaptchaVerifyService(
            new CaptchaRepository($this->cache)
        );
        if (!$captchaVerify->exec($data['id'], $data['code'])) {
            return error_response('验证码错误');
        }

        // 原样返回
        return success_response($data);
    }
}