<?php

namespace App\Services;

use App\Queries\FolderQuery;
use Exception;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class FolderService
{
    private $folderQuery;
    public function __construct(FolderQuery $folderQuery)
    {
        $this->folderQuery = $folderQuery;
    }
    public function getAllFolders()
    {
        try {
            $folderModels = $this->folderQuery->getAll();

            $data = [];
            foreach ($folderModels as $folder) {
                $data[] = [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'created_at' => str($folder->created_at),
                    'updated_at' => str($folder->updated_at),
                ];
            }

            return $data;
        } catch (Exception $e) {
            throw new InternalErrorException("Failed to fetch parent folder : " . str($e));
        }
    }
    public function getAllSubFolder($folder_id)
    {
        try {
            $subFolders = $this->folderQuery->findSubFolder($folder_id);

            $data = [];
            foreach ($subFolders as $subFolder) {
                $data = [
                    'id' => $subFolder->id,
                    'name' => $subFolder->name,
                    'created_at' => str($subFolder->created_at),
                    'updated_at' => str($subFolder->updated_at),
                    'sub_folders' => []
                ];
            }

            if (!empty($subFolder->sub_folders)) {
                foreach ($subFolder->sub_folders as $subFolder) {
                    $data['sub_folders'][] = [
                        'id' => $subFolder->id,
                        'folder_id' => $subFolder->folder_id,
                        'name' => $subFolder->name,
                        'type' => $subFolder->type,
                        'size' => $subFolder->size,
                        'created_at' => str($subFolder->created_at),
                        'updated_at' => str($subFolder->updated_at),
                    ];
                }
            }

            return $data;
        } catch (Exception $e) {
            throw new InternalErrorException("Failed to fetch sub folder in folder : " . str($e));
        }
    }
    
}
