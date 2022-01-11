<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use SoftDeletes;

    protected $table = 'jadwal';
    public $timestamps = false;
    protected $primaryKey = 'id';

    function home()
    {
        return $this->belongsTo('App\Models\Tim','home_id','id');
    }

    function away()
    {
        return $this->belongsTo('App\Models\Tim','away_id','id');
    }

    function goal()
    {
        return $this->hasMany('App\Models\Pertandingan','jadwal_id','id');
    }
}
