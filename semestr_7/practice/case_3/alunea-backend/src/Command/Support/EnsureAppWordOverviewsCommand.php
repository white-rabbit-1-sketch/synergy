<?php

namespace App\Command\Support;

use App\Message\EnsureAppWordOverviewMessage;
use App\Service\UserWordReferenceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'support:app-word-overviews:ensure')]
class EnsureAppWordOverviewsCommand extends Command
{
    public function __construct(
        protected UserWordReferenceService $userWordReferenceService,
        protected MessageBusInterface $messageBus,
        ?string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->userWordReferenceService->getUserWordReferences() as $userWordReference) {
            $this->messageBus->dispatch(new EnsureAppWordOverviewMessage(
                $userWordReference->getId(),
                $userWordReference->getUser()->getNativeLanguage()->getCode()
            ));
        }

        return Command::SUCCESS;
    }
}