<?php

namespace App\Normalizer;

use App\Entity\User;
use App\Service\UserLanguageReferenceService;
use App\Service\UserPhraseReferenceService;
use App\Service\UserWordReferenceService;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerAwareInterface, NormalizerInterface
{
    use NormalizerAwareTrait;

    public function __construct(
        protected UserWordReferenceService $userWordReferenceService,
        protected UserPhraseReferenceService $userPhraseReferenceService,
        protected UserLanguageReferenceService $userLanguageReferenceService
    )
    {
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        /** @var User $object */
        return [
            'id' => $object->getId(),
            'email' => $object->getEmail(),
            'nativeLanguage' => $this->normalizer->normalize($object->getNativeLanguage(), $format, $context),
            'showSecondarySubtitles' => $object->getShowSecondarySubtitles(),
            'highlightRecommendedWords' => $object->getHighlightRecommendedWords(),
            'highlightWordsInStudy' => $object->getHighlightWordsInStudy(),
            'primarySubtitleSize' => $object->getPrimarySubtitleSize(),
            'secondarySubtitleSize' => $object->getSecondarySubtitleSize(),
            'optIn' => $object->getOptIn(),
        ];
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            User::class => true,
        ];
    }
}