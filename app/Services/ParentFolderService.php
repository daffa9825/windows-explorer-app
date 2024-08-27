<?php

namespace App\Services;

use App\Queries\ParentFolderQuery;
use Exception;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class ParentFolderService
{
    private $parentFolderQuery;
    public function __construct(ParentFolderQuery $parentFolderQuery)
    {
        $this->parentFolderQuery = $parentFolderQuery;
    }
    public function getAllParentFolders()
    {
        try {
            $parentFolderModels = $this->parentFolderQuery->getAll();

            $data = [];
            foreach ($parentFolderModels as $folder) {
                $data[] = [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'created_at' => $folder->created_at,
                    'updated_at' => $folder->updated_at,
                ];
            }

            return $data;
        } catch (Exception $e) {
            throw new InternalErrorException("Failed to fetch parent folders : " . str($e));
        }
    }
}
