<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CalculationFormatEnum extends Enum
{
    const add =   0;
    const sub =   1;
    const mul = 2;
}
