<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiSubMateri extends Model
{
    use HasFactory;

    protected $table = 'isi_sub_materi';

    protected $fillable = ['id','judul_sub', 'text', 'sub_materi_id'];   
}
