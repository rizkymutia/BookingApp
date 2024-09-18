<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'name',
        'ruang',
    ];


}
