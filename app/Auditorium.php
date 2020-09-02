<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditorium extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auditoriums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'end',
    ];

    /**
     * The schedules that this auditorium has.
     */
    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}
