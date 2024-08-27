<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentFolder extends Model
{
    use HasFactory;
    protected $table = 'parent_folders';
    protected $fillable = [
        'id',
        'name',
    ];

    public function sub_parents()
    {
        return $this->hasMany(SubFolder::class);
    }
}
