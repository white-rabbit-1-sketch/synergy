<?php

namespace App\Tests\Factory;

use App\Entity\User;
use App\Service\StringService;
use App\Service\UserService;

class UserFactory
{
    public function __construct(
        protected UserService $userService,
        protected StringService $stringService,
    )
    {
    }

    public function createUser(): User
    {
        $randomString = uniqid('', true);

        return $this->userService->createUser(
            $this->stringService->createRandomString(),
            $randomString,
            '127.0.0.1'
        );
    }
}