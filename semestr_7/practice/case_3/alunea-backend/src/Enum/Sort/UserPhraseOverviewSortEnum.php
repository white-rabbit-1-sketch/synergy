<?php

namespace App\Enum\Sort;

enum UserPhraseOverviewSortEnum: string
{
    public const NEWEST = 'newest';
    public const OLDEST = 'oldest';
    public const ALPHABETICAL = 'alphabetical';
    public const ALPHABETICAL_REVERSED = 'alphabetical-reversed';
    public const USAGE_FREQUENCY = 'usage-frequency';
    public const USAGE_FREQUENCY_REVERSED = 'usage-frequency-reversed';
    public const CEFR_LEVEL = 'cefr-level';
    public const CEFR_LEVEL_REVERSED = 'cefr-level-reversed';
}
