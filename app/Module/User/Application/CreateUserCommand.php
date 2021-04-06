<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application;

class CreateUserCommand
{
    private string $phone;

    private string $password;

    private string $role;

    public function __construct(string $phone, string $password, string $role)
    {
        $this->phone = $phone;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }
}