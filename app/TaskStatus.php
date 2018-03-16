<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public $timestamps = false;

}
