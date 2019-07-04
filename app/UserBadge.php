<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    //
    protected $fillable = ['user_id', 'badge_id', 'state', 'score'];
}
