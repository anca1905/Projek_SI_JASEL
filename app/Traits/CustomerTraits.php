<?php

namespace App\Traits;

trait CustomerTraits
{
    public function uploadCv($request){
        $file = $request->file('resume');
        $fileName = date('Y-m-d') . $file->getClientOriginalName();
        $file->storeAs('CV', $fileName);
        return $fileName;
    }
}