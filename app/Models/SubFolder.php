<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFolder extends Model
{
    use HasFactory;
    protected $table = 'sub_folders';
    protected $fillable = [
        'id',
        'folder_id',
        'type',
        'name',
    ];
    public function folders()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
