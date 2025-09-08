<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

trait FileTraits
{
    protected string $name;

    public function initFileName(string $extension): void
    {
        $this->name = date('Y-m-d') . '-' . microtime(true) . '.' . $extension;
    }

    public function uploadFile($file, $isBase64 = false)
    {
        if (!$isBase64) {

            $this->initFileName($file->getClientOriginalExtension());
            $fileName = $this->name;
            $path = 'foto/' . $fileName;

            Storage::disk('public')->put($path, file_get_contents($file));

            return $fileName;
        } else {


            // $file = preg_replace('/^data:image\/\w+;base64,/', '', $file);
            if (preg_match('/^data:image\/(\w+);base64,/', $file, $type)) {
                $extension = strtolower($type[1]);
            } else {
                throw new \Exception('Invalid base64 image data');
            }
            $file = str_replace(' ', '+', $file);

            $imageData = base64_decode($file);

            $this->initFileName($extension);  
            $fileName = $this->name;  


            Storage::disk('public')->put($fileName, $imageData);

            return $fileName;
        }
    }
}
