<?php

namespace App\Http\Controllers;

use App\Exceptions\FileUploadException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Traits\FileTraits;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    use FileTraits;

    public function upload(FileRequest $request)
    {
        try {
            $data = $request->validated();
            $file = $request->file('file');
            $fileData = $this->uploadFile($file);

            // dd($fileData);
            
            $data['user_id'] = auth('api')->id();
            $data['file_name'] = $fileData;
            $data['file_path'] = 'storage/' . $fileData;
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
            File::create($data);

            return ResponseHelper::success($fileData, 'File berhasil di upload');
        } catch (\Throwable $e) {
            Log::error("Upload gagal: " . $e->getMessage());
            return ResponseHelper::error($e->getMessage(), 400);
        }
    }

    public function uploadBase64(Request $request)
    {
        try {

            $fileName = $this->uploadFile($request->input('file'), true);
            return ResponseHelper::success($fileName, 'Image berhasil di upload');
        } catch (\Throwable $th) {
            Log::error("Upload base64 gagal: " . $th->getMessage());
            return ResponseHelper::error($th->getMessage(), 400);
        }
    }
}
