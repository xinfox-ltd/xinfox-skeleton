<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Wechat;

interface ApiInterface
{
    public function getMethod(): string;

    public function getUri(): string;

    public function getOptions(): array;
}