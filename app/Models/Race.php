<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Race extends Model
{
    use HasFactory;
   

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->format('Y/m/d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->format('Y/m/d');
    }

    public function getStartDateAttribute($value)
    {
       return   Carbon::parse($value)->format('Y-m-d');
    }

    public function getEndDateAttribute($value)
    {
       
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function joinedMembers()
    {
        return $this->belongsToMany('App\Models\User', 'race_users');
    }

    public function winnerMemeber()
    {
        return $this->belongsTo('App\Models\User', 'winner_id');
    }
}

