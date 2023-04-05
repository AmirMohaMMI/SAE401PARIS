<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RENCONTRE extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'RENCONTRE';
    protected $primaryKey = 'idrencontre';
}
