<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Path;

class Location extends Model
{
    use HasFactory;

    /**
     * The path that leads to this location
     */
    public function path() {
      return $this->hasOne(Path::class);
    }
}
