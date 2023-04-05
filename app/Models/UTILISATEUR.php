<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UTILISATEUR extends Model
{
    use HasFactory;
    protected $table = 'UTILISATEUR';
    protected $primaryKey = 'iduti';
    public $timestamps = false;
}
