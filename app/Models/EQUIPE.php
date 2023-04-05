<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EQUIPE extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'EQUIPE';
    protected $primaryKey = 'idequipe';
}
