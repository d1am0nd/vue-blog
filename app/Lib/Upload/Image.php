<?php

namespace App\Lib\Upload;

use File;
use Image as ImageLib;
use App\Lib\Upload\UploadFileInterface;

class Image implements UploadFileInterface
{
    public function __construct()
    {

    }

    public function uploadToDir($image, $folder, $name)
    {
        if(!File::exists(public_path($folder))) {
            if(!File::makeDirectory(public_path($folder), 0775, true)) {
                throw new \Exception("Cant create folder $folder");
            }
        }

        $index = 0;
        $newName = $name . '.jpg';
        do {
            if($index !== 0) {
                $newName = $name . $index . '.jpg';
            }
            $index += 1;
        } while (File::exists(public_path($folder . '/' . $newName)));
        $filePath = $folder . '/' . $newName;

        $img = ImageLib::make($image);
        $img->save(public_path($filePath));

        return $newName;
    }

    public function deleteIfExists($file)
    {
        $path = public_path($file);
        if (!File::exists($path)) {
            return false;
        }
        File::delete($path);
        return true;
    }

}
