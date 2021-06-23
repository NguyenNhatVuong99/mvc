<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ParentPriceFormatEnum extends Enum
{
    const cost_price = 1;
    const now_price = 2;
}
