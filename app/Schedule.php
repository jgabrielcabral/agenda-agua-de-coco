<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedules';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'init',
        'end',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'init',
        'end',
    ];

    /**
     * The user who this schedules belongs to.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The auditorium that this schedule belongs to.
     */
    public function auditorium() {
        return $this->belongsTo('App\Auditorium');
    }
}
