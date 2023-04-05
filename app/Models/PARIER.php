<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PARIER extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'PARIER';
    protected $primaryKey = 'idpari';
}
