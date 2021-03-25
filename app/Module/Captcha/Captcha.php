<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha;

class Captcha
{
    private $id;
    private $code;
    private string $type;
    private $src;

    public function __construct(string $type, $id, $src, $code)
    {
        $this->type = $type;
        $this->id = $id;
        $this->src = $src;
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getSrc()
    {
        return $this->src;
    }
}