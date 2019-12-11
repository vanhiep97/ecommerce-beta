<?php
namespace App\Traits;

trait UploadTrait {
    public function uploadFile($pathSaveFile, $name)
    {
        $file = $name;
        $fileName = time() . $file->getClientOriginalName();
        $file->move($pathSaveFile, $fileName);
        return $fileName;
    }

    public function deleteFile($pathSaveFile, $fileName)
    {
        $uriFile = $pathSaveFile.'/'.$fileName;
        if (file_exists($uriFile)) {
            unlink($uriFile);
            return true;
        } else {
            return false;
        }
    }
}
