<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UploadCkeditorImageService;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    /**
     * @param Request $request
     * @param UploadCkeditorImageService $ckeditorImageUploadService
     * @return array|string
     */
    public function upload(Request $request, UploadCkeditorImageService $ckeditorImageUploadService)
    {
        return $ckeditorImageUploadService->upload($request);
    }
}
