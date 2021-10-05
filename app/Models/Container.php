<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BenSampo\Enum\Traits\CastsEnums;
use App\Enums\ContainerStatus;

class Container extends Model
{
    use HasFactory;
    use CastsEnums;

    protected $casts = [
      'status' => ContainerStatus::class,
    ];
}
