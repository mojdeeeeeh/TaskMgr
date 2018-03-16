<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $appends = ['persianStartDate', 'persianFinishDate'];

   

    public function getPersianStartDateAttribute()
    {
        return $this->startPersian();  
    }

    public function getPersianFinishDateAttribute()
    {
        return $this->finishPersian();  
    }

	protected $guarded = [
        'id'
    ];

    public function sender_user()
    {
        return $this->belongsTo(\App\User::class, 'sender_user_id', 'id');
    }

     public function functor_user()
    {
        return $this->belongsTo(\App\User::class, 'functor_user_id', 'id');
    }

     public function seconder_user()
    {
        return $this->belongsTo(\App\User::class, 'seconder_user_id', 'id');
    }

   

    public function TaskStatus()
    {
        return $this->belongsTo(\App\TaskStatus::class);
    }

    /**
     * Start date (Persian date)
     *
     * @return     \     ( description_of_the_return_value )
     */
    public function startPersian()
    {
        $verta  = new \Verta($this->start);

        $result = $verta->format('Y-n-j H:i');

        return $result;
    }

    /**
     * finish date (Persian date)
     *
     * @return     \     ( description_of_the_return_value )
     */
    public function finishPersian()
    {
        $verta = new \Verta($this->finish);

        $result = $verta->format('Y-n-j H:i');

        return $result;
    }

   
}
