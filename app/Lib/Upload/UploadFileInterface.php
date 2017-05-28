<?php

namespace App\Lib\Upload;

interface UploadFileInterface
{
    /**
     * Uploads a file to public directory, appends
     * numbers to name if file already exists
     * @param  [type] $file     File, specific to implementation
     * @param  string $folder   Folder within public directory
     * @param  string $fileName Name of the file
     * @return string           New file name
     */
    public function uploadToDir($file, $folder, $fileName);

    /**
     * Deletes $file if it exists
     * @param  string $file File path relative to public folder (including filename)
     * @return bool         True if deleted, false if not
     */
    public function deleteIfExists($file);
}
