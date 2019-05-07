<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'smses';
    protected $guarded = [];

    public function contact()
    {
        return $this->hasOne('App\Models\Contact','id','contact_id');
    }
}
