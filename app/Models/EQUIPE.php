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

    protected $fillable = [
        "equipe1",
        "equipe2",
        "jeux",
        "daterenc",
        "cote_equipe1",
        "cote_equipe2",
        "idtournois"
    ];


}

