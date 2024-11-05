<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $table = 'user_data';
    protected $primaryKey = 'user_id'; // Pastikan primary key ditentukan
    public $incrementing = true; // Apakah kolom id adalah auto-increment

    protected $fillable = [
        'name',
        'email',
        'ruang',
        'kegiatan',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
    ];
}
