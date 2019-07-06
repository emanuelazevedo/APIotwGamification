<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    //
    protected $fillable = ['name', 'description', 'level', 'finalResult'];

    public function userBadge()
    {
        return $this->hasMany(UserBadge::class);
    }
}
