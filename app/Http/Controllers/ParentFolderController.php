<?php

namespace App\Http\Controllers;

use App\Services\ParentFolderService;
use Illuminate\Http\Request;

class ParentFolderController extends Controller
{
    private $parentFolderService;
    public function __construct(ParentFolderService $parentFolderService)
    {
        $this->parentFolderService = $parentFolderService;
    }
    public function listParentFolder()
    {
        $parentFolders = $this->parentFolderService->getAllParentFolders();

        if (empty($parentFolders)) {
            return getResponseApi('success', [], 'No parent folders found.');
        }

        return getResponseApi('success', $parentFolders, 'Successfully retrieved data!');
    }
}
