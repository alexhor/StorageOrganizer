<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static Created()
 * @method static Packing()
 * @method static Packed()
 * @method static Checked()
 * @method static Touring()
 * @method static Returned()
 * @method static Finished()
 */
final class PacklistStatus extends Enum
{
    const Created = 0;
    const Packing = 1;
    const Packed = 2;
    const Checked = 3;
    const Touring = 4;
    const Returned = 5;
    const Finished = 6;
}
