<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IsiSubMateri;

class SubMateri extends Model
{
    use HasFactory;

    protected $table = 'sub_materi';

    protected $fillable = ['judul_sub', 'materi_id'];

    public function isiSubMateri()
    {
        return $this->hasMany(IsiSubMateri::class);
    }
}
