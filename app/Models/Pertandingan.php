<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertandingan extends Model
{
    use SoftDeletes;

    protected $table = 'pertandingan';
    public $timestamps = false;
    protected $primaryKey = 'id';

    function goal()
    {
        return $this->belongsTo('App\Models\Pemain','player_id','id');
    }

    function assist()
    {
        return $this->belongsTo('App\Models\Pemain','assist_id');
    }

}
