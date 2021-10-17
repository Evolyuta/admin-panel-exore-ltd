<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;

class FileService
{
    /**
     * Uploading file
     *
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    public function upload(UploadedFile $file, string $path): string
    {
        $imageName = time() . '.' . $file->extension();

        $file->move(public_path($path), $imageName);

        return '/' . $path . '/' . $imageName;
    }
}
