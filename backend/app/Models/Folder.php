<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{    
    use HasFactory;
    protected $table = 'folders';
    protected $fillable = [
        'id',
        'name',
    ];

    public function sub_folders()
    {
        return $this->hasMany(SubFolder::class);
    }
}
