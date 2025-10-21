<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as AbstractBaseController;

abstract class AbstractController extends AbstractBaseController
{
    protected function getUser(): ?User
    {
        $user = parent::getUser();
        if ($user && !($user instanceof User)) {
            throw new \Exception('User should be an instance of User class');
        }

        return $user;
    }
}