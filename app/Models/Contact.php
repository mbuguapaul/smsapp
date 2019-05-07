<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function community()
    {
        return $this->hasOne('App\Models\Community','id','community_id');
    }
}
