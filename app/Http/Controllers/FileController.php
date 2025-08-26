<?php

namespace App\Http\Controllers;

use App\Exceptions\FileUploadException;
use App\Helpers\ResponseHelper;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        try {
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

            return ResponseHelper::success($fileData, 'File berhasil di upload');
        } catch (\Throwable $e) {
            Log::error("Upload gagal: " . $e->getMessage());
            return ResponseHelper::error($e->getMessage(), 400);
        }
    }

    public function image(Request $request)
    {
        // Validasi file (form-data)
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg|max:2048', // max 2MB
        ]);

        // Simpan file
        $path = $request->file('file')->store('uploads', 'public');

        return response()->json([
            'message' => 'File uploaded successfully',
            'path' => asset('storage/' . $path)
        ], 201);
    }

    public function uploadBase64(Request $request)
    {
        // Ambil base64 string
        $image = $request->input('image');

        // Hapus "data:image/png;base64," di depannya
        $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $image = str_replace(' ', '+', $image);

        // Decode base64
        $imageData = base64_decode($image);

        // Nama file unik
        $fileName = uniqid() . '.png';

        // Simpan ke storage/app/public
        Storage::disk('public')->put($fileName, $imageData);

        return response()->json([
            'success' => true,
            'file' => $fileName
        ], 201);
    }
}
