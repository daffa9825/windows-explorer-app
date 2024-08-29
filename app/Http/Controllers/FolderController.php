<?php

namespace App\Http\Controllers;
use App\Services\FolderService;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    private $folderService;
    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }
    public function listFolder()
    {
        $folders = $this->folderService->getAllFolders();

        if (empty($folders)) {
            return getResponseApi('success', [], 'No folder found.');
        }

        return getResponseApi('success', $folders, 'Successfully retrieved data!');
    }
    public function listSubfolder($folder_id)
    {
        $subFolders = $this->folderService->getAllSubFolder($folder_id);

        if (empty($subFolders)) {
            return getResponseApi('success', [], 'No sub folder found in folder.');
        }

        return getResponseApi('success', $subFolders, 'Successfully retrieved data!');
    }
}
