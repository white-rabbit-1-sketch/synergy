<?php

namespace App\EventListener;

use App\Entity\User;
use App\Service\UserRequestStatisticService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class RequestListener
{
    public function __construct(
        protected UserRequestStatisticService $userRequestStatisticService,
        protected Security $security
    )
    {
    }

    #[AsEventListener]
    public function onKernelRequest(RequestEvent $event): void
    {
        $user = $this->security->getUser();
        if (
            !$event->isMainRequest() ||
            !$event->getRequest()->attributes->has('_controller') ||
            !($user instanceof User)
        ) {
            return;
        }

        $this->userRequestStatisticService->incrementRequestCount(
            $user,
            $event->getRequest()->attributes->get('_controller')
        );
    }
}