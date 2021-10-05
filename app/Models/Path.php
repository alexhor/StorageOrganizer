<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BenSampo\Enum\Traits\CastsEnums;
use App\Models\Location;

class Path extends Model
{
    use HasFactory;

    /**
     * The location this path leads to
     */
    public function location() {
      return $this->belongsTo(Location::class);
    }
}
