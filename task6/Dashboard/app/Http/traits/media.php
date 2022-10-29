<?php

namespace App\Http\traits;

trait media
{

    public function upload_photo($image, $folder)
    {
        $photoName = uniqid() . '.' . $image->extension();
        $image->move(public_path('/dist/img/' . $folder), $photoName);
        return $photoName;
    }

    public function delete_photo($photoPath)
    {
        if (file_exists($photoPath)) {
            unlink($photoPath); // delete image
            return true;
        }
        return false;
    }
}
