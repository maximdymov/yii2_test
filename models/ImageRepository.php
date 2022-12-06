<?php

namespace app\models;

use yii\helpers\BaseInflector;
use yii\web\UploadedFile;

class ImageRepository
{
    public static function add(UploadedFile $image) {
        $name = $image->baseName;
        $name = BaseInflector::transliterate($name);
        $name = BaseInflector::underscore($name);

        $newImage = new Image();
        $newImage->title = $name . '.' . $image->extension;
        $newImage->time = date('Y-m-d h:i:s', time());

        if (!$newImage->validate()) {
            $newImage->title = $name . uniqid() . '.' . $image->extension;
        }

        $newImage->save();
        return $newImage->title;
    }

    public static function getAll(): array
    {
        return Image::find()->all();
    }
}