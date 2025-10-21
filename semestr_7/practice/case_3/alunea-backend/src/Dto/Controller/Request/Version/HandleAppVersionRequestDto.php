<?php

namespace App\Dto\Controller\Request\Version;

use App\Enum\RegexpPatternEnum;
use Symfony\Component\Validator\Constraints as Assert;

class HandleAppVersionRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Regex([
            'pattern' => RegexpPatternEnum::VERSION,
            'message' => 'Version is invalid',
        ])]
        protected string $version,
    ) {
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}