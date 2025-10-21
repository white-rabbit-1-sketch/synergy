<?php

namespace App\Dto\Controller\Response\Word;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Entity\Word;

class GetWordResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected Word $word,
    )
    {
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }
}