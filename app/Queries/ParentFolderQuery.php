<?php

namespace App\Queries;

use App\Models\ParentFolder;

class ParentFolderQuery
{
    public function getAll()
    {
        return ParentFolder::all();
    }
}
