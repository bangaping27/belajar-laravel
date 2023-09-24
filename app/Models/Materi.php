<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubMateri;
use App\Models\IsiSubMateri;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $fillable = ['nama_materi', 'progres'];

    public function subMateri()
    {
        return $this->hasMany(SubMateri::class);
    }

public function isiSubMateri()
{
    return $this->hasMany(IsiSubMateri::class);
}
}