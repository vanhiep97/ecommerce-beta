<?php
namespace App\Traits;

trait UploadMutiFileTrait {
    public function uploadMultiFile($pathSaveFile, $name)
    {
        $files = $name;
        $gallery = [];
        foreach ($files as $key => $value)
        {
            $id = $key + 1;
            $fileName = time() . $value->getClientOriginalName();
            $value->move($pathSaveFile, $fileName);
            $galleryItem = [
                'id' => $id,
                'fileName' => $fileName,
            ];
            array_push($gallery,$galleryItem);
        }
        return json_encode($gallery);
    }

//    public function deleteFile($pathSaveFile, $fileName)
//    {
//        $uriFile = $pathSaveFile.'/'.$fileName;
//        if (file_exists($uriFile)) {
//            unlink($uriFile);
//            return true;
//        } else {
//            return false;
//        }
//    }
}
