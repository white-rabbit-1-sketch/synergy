<?php

namespace App\Dto\Controller\Request\Security;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserAuthTokenRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email(message: "Invalid email address")]
        #[Assert\Length(
            min: 6,
            max: 254,
            minMessage: 'Email must be at least {{ limit }} characters long',
            maxMessage: 'Email cannot be longer than {{ limit }} characters',
        )]
        protected string $email,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 8,
            max: 128,
            minMessage: 'Password must be at least {{ limit }} characters long',
            maxMessage: 'Password cannot be longer than {{ limit }} characters',
        )]
        protected string $password,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}