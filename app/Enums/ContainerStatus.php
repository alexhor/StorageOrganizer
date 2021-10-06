<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static Working()
 * @method static NeedsRepair()
 * @method static NeedsReplacement()
 * @method static NeedsCheckup()
 * @method static Broken()
 */
final class ContainerStatus extends Enum implements LocalizedEnum
{
    const Working =   0;
    const NeedsRepair =   1;
    const NeedsReplacement = 2;
    const NeedsCheckup = 3;
    const Broken = 4;
}
