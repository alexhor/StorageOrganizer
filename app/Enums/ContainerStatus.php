<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Working()
 * @method static static NeedsRepair()
 * @method static static NeedsReplacement()
 * @method static static NeedsCheckup()
 * @method static static Broken()
 */
final class ContainerStatus extends Enum implements LocalizedEnum
{
    const Working =   0;
    const NeedsRepair =   1;
    const NeedsReplacement = 2;
    const NeedsCheckup = 3;
    const Broken = 4;
}
