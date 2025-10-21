<?php

namespace App\Enum;

enum CefrLevelEnum: string
{
    const A0 = 'A0';
    const A1 = 'A1';
    const A2 = 'A2';
    const B1 = 'B1';
    const B2 = 'B2';
    const C1 = 'C1';
    const C2 = 'C2';

    const CEFR_LEVELS = [
        self::A0,
        self::A1,
        self::A2,
        self::B1,
        self::B2,
        self::C1,
        self::C2,
    ];

    public static function getPreviousLevel(?string $level): ?string
    {
        $index = array_search($level, self::CEFR_LEVELS, true);

        if ($index === false || $index === 0) {
            return null;
        }

        return self::CEFR_LEVELS[$index - 1];
    }

    public static function getNextLevel(?string $level): ?string
    {
        $index = array_search($level, self::CEFR_LEVELS, true);

        if ($index === false || $index === count(self::CEFR_LEVELS) - 1) {
            return null;
        }

        return self::CEFR_LEVELS[$index + 1];
    }
}
