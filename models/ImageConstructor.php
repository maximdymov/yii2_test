<?php

namespace app\models;

use yii\helpers\BaseInflector;
use yii\web\UploadedFile;

class ImageConstructor
{
    public static function createImage(UploadedFile $file)
    {
        $image = new Image();
        self::setTitle($image, $file);
        self::setDate($image);
        return $image;
    }

    private static function setDate(Image $img)
    {
        $img->time = date('Y-m-d h:i:s', time());
    }

    private static function setTitle(Image $img, UploadedFile $file)
    {
        $title = self::titleCorrectFormat($file->baseName);

        $img->title = $title . '.' . $file->extension;

        if (!$img->validate()) {
            $img->title = $title . uniqid() . '.' . $file->extension;
        }
    }

    private static function titleCorrectFormat(string $str): string
    {
        $name = BaseInflector::transliterate($str);
        $name = BaseInflector::underscore($name);
        return $name;
    }
}