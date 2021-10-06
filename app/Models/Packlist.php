<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BenSampo\Enum\Traits\CastsEnums;
use App\Enums\PacklistStatus;

class Packlist extends Model
{
    use HasFactory;
    use CastsEnums;

    protected $casts = [
      'status' => PacklistStatus::class,
    ];

    public function containerList() {
      return $this->belongsToMany(Container::class, 'packlist_containers', 'packlist_id', 'container_id');
    }
}
