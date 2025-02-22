<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function process (Request $request)
    {
        $files = $request->allFiles();

        if (empty($files)) {
            abort(422, 'No files uploaded!');
        }

        if (count($files) > 1) {
            abort(422, 'You can upload one file at a time!');
        }

        $requestKey = array_key_first($files);

        $file = is_array($request->input($requestKey)) ? $request->file($requestKey)[0] : $request->file($requestKey);

        return $file->store(path: 'tmp/'.now()->timestamp.'-'.Str::random(20));
    }
}
