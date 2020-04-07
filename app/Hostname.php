<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hostname extends Model
{
    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }
}
