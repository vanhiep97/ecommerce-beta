<?php
namespace App\Traits;

trait UploadEditorTrait {
    public function uploadEditorTinyMCE($pathSaveFile, $name)
    {
        $file = $name;
        $pathFile = $pathSaveFile.'/'.$file->getClientOriginalName();;
        $fileName = time() . $file->getClientOriginalName();
        $file->move($pathSaveFile, $fileName);
        return json_encode(['location' => $pathFile]);
    }
}
