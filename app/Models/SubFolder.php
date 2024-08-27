<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFolder extends Model
{
    use HasFactory;
    protected $table = 'sub_parent_folders';
    protected $fillable = [
        'id',
        'parent_folder_id',
        'name',
    ];
    public function parent_folders()
    {
        return $this->belongsTo(ParentFolder::class, 'parent_folder_id');
    }
}
