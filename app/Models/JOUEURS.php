<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JOUEURS extends Model
{
    use HasFactory;
    protected $table = 'JOUEURS';
    protected $primaryKey = 'idjoueur';
}
