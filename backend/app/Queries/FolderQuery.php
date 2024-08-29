<?php

namespace App\Queries;

use App\Models\Folder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FolderQuery
{
    public function getAll()
    {
        return Folder::all();
    }
    public function findSubFolder($folder_id){
        $folder = Folder::find($folder_id);
        if (!$folder) {
            throw new ModelNotFoundException("Folder not found.");
        }
        $query = Folder::where('id', $folder_id)->with('sub_folders')->get();
        return $query;
    }
}
