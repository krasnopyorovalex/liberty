<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Support\Str;
use Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    /**
     * @param FileRequest $request
     * @return StreamedResponse
     */
    public function __invoke(FileRequest $request): StreamedResponse
    {
        $file = $request->get('file');

        return Storage::download(Str::replace('storage', 'public', $file));
    }
}
