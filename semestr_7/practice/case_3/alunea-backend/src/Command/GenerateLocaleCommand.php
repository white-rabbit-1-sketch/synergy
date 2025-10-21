<?php

namespace App\Command;

use App\Entity\Language;
use App\Service\AiService;
use App\Service\LanguageService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'locale:generate')]
class GenerateLocaleCommand extends Command
{
    protected const BATCH_SIZE = 10;
    protected string $localePath;

    public function __construct(
        protected LanguageService $languageService,
        protected AiService       $aiService,
        protected LoggerInterface $logger,
        ?string                   $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->addArgument('locale-path', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->localePath = $input->getArgument('locale-path');
        $defaultLanguage = $this->languageService->getDefaultLanguage();
        $languages = $this->languageService->getLanguages();

        $this->logger->info('Default language determined', ['defaultLanguageCode' => $defaultLanguage->getCode()]);

        $defaultLocaleData = $this->getLocaleDataByLanguage($defaultLanguage);

        $promises = [];
        foreach ($languages as $language) {
            if ($language->getCode() === $defaultLanguage->getCode()) {
                continue;
            }

            $languageLocaleData = $this->getLocaleDataByLanguage($language);
            $missingLocaleData = array_diff_key($defaultLocaleData, $languageLocaleData);
            if (!$missingLocaleData) {
                $this->logger->info('Locale looks fine, skipping', ['languageCode' => $language->getCode()]);
                continue;
            }

            $this->logger->debug('Missing locale data determined', [
                'languageCode' => $language->getCode(),
                'missingLocaleData' => $missingLocaleData,
            ]);

            $promises[] = $this->aiService->translateLocale($language, $missingLocaleData)
                ->then(function ($translatedLocaleData) use ($language, $languageLocaleData) {
                    $mergedData = array_merge($languageLocaleData, $translatedLocaleData);

                    $this->logger->debug('Locale data merged', [
                        'languageCode' => $language->getCode(),
                        'languageLocaleData' => $mergedData,
                    ]);

                    $this->setLocaleDataByLanguage($language, $mergedData);

                    $this->logger->info('Locale data updated', [
                        'languageCode' => $language->getCode(),
                    ]);
                });

            if (count($promises) >= self::BATCH_SIZE) {
                $this->waitAll($promises);
                $promises = [];
            }
        }

        if (!empty($promises)) {
            $this->waitAll($promises);
        }

        return Command::SUCCESS;
    }

    protected function getLocaleDataByLanguage(Language $language): array
    {
        $filePath = $this->getLocaleFilePathByLanguage($language);

        return file_exists($filePath) ? json_decode(
            file_get_contents($filePath),
            true
        ) : [];
    }

    protected function setLocaleDataByLanguage(Language $language, array $localeData): void
    {
        $filePath = $this->getLocaleFilePathByLanguage($language);
        file_put_contents($filePath, json_encode($localeData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    protected function getLocaleFilePathByLanguage(Language $language): string
    {
        return sprintf('%s/%s.json', $this->localePath, $language->getCode());
    }

    protected function waitAll(array $promises): void
    {
        foreach ($promises as $promise) {
            $promise->wait();
        }
    }
}
