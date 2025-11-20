<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Support\FileName;
use Illuminate\Support\Facades\Storage;

class MediaController
{
    public function upload(Request $request)
    {

        $inputName = $request->hasFile('upload') ? 'upload' : 'file';

        if (!$request->hasFile($inputName)) {
            return $this->ckeditorError('No file uploaded');
        }

        $request->validate([
            $inputName => 'required|image|max:4096'
        ]);

        $file = $request->file($inputName);

        $name = FileName::sanitize($file->getClientOriginalName());

        $path = $file->storeAs('pages', $name, 'public');

        if ($request->hasFile('file')) {
            return response()->json([
                'data' => ['src' => Storage::url($path)]
            ]);
        }

        $url = Storage::url($path);

        if ($request->has('CKEditorFuncNum')) {
            $funcNum = $request->input('CKEditorFuncNum');
            return response(
                "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '');</script>"
            )->header('Content-Type', 'text/html');
        }

        return response()->json([
            'uploaded' => 1,
            'fileName' => $name,
            'url' => Storage::url($path),
        ]);
    }

    private function ckeditorError($message)
    {
        if ($funcNum = request()->input('CKEditorFuncNum')) {
            return response(
                "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '', '$message');</script>"
            )->header('Content-Type', 'text/html');
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => $message]
        ], 422);
    }
}
