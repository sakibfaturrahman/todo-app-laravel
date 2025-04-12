<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primarykey = 'id';
    protected $fillable = ['nama_kategori'];

    public function task()
    {
        return $this->hasMany(Task::class,'kategori_id');
    }
}
