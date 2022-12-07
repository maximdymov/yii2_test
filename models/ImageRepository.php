<?php

namespace app\models;

use yii\web\UploadedFile;

class ImageRepository
{
    public static function create(UploadedFile $file)
    {
        $image = ImageConstructor::createImage($file);
        $image->save();
        return $image->title;
    }
}