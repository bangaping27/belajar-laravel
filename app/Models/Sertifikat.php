<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats'; // Nama tabel yang sesuai
    protected $fillable = ['nama', 'code']; // Kolom yang dapat diisi
}
