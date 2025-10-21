<?php

namespace App\Command;

use App\Message\EnsureAppPhraseOverviewMessage;
use App\Service\TokenService;
use App\Service\UserPhraseReferenceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'tokens:expired:remove')]
class RemoveExpiredTokensCommand extends Command
{
    public function __construct(
        protected TokenService $tokenService,
        ?string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->tokenService->removeExpiredTokens();

        return Command::SUCCESS;
    }
}