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
        'nomor',
        'ruang',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
    ];

    // Mutator untuk memastikan nomor telepon dalam format internasional
    public function setPhoneNumberAttribute($value)
    {
        // Cek apakah nomor sudah mengandung kode negara
        if (substr($value, 0, 1) !== '+') {
            // Jika tidak ada kode negara, tambahkan kode negara (mis. +62)
            $value = '+62' . ltrim($value, '0'); // Menghapus 0 di awal jika ada
        }

        // Simpan nomor telepon yang telah diformat
        $this->attributes['nomor'] = $value;
    }
}
