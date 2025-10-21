<?php

namespace App\Command\Support;

use App\Message\EnsureAppPhraseOverviewMessage;
use App\Service\UserPhraseReferenceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'support:app-phrase-overviews:ensure')]
class EnsureAppPhraseOverviewsCommand extends Command
{
    public function __construct(
        protected UserPhraseReferenceService $userPhraseReferenceService,
        protected MessageBusInterface $messageBus,
        ?string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->userPhraseReferenceService->getUserPhraseReferences() as $userPhraseReference) {
            $this->messageBus->dispatch(new EnsureAppPhraseOverviewMessage(
                $userPhraseReference->getId(),
                $userPhraseReference->getUser()->getNativeLanguage()->getCode()
            ));
        }

        return Command::SUCCESS;
    }
}