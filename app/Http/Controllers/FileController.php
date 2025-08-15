<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        // Simpan metadata ke database
        $fileData = File::create([
            'user_id'   => auth('api')->id(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => 'storage/' . $path,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize()
        ]);

        return response()->json([
            'message' => 'File berhasil diupload',
            'data'    => $fileData
        ], 201);
    }
}
