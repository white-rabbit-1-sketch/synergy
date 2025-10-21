<?php

namespace App\Normalizer;

use App\Dto\Entity\WordVariant;
use App\Service\PhraseTranslationService;
use App\Service\UserPhraseReferenceService;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WordVariantNormalizer implements NormalizerAwareInterface, NormalizerInterface
{
    use NormalizerAwareTrait;

    public function __construct(
        protected PhraseTranslationService $phraseTranslationService,
        protected UserPhraseReferenceService $userPhraseReferenceService
    )
    {
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        /** @var WordVariant $object */
        return [
            'type' => $object->getType(),
            'value' => $object->getValue(),
            'word' => $this->normalizer->normalize($object->getWord(), $format, $context),
        ];
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof WordVariant;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            WordVariant::class => true,
        ];
    }
}