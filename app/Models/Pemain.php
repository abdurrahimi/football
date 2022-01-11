<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemain extends Model
{
    use SoftDeletes;

    protected $table = 'pemain';
    public $timestamps = false;
    protected $primaryKey = 'id';
}
