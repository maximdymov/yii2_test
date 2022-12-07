<?php

namespace app\models;

use PhpParser\Node\Expr\Cast\Int_;
use yii\base\Model;
use yii\helpers\BaseInflector;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $images;

    public function rules()
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5]
        ];
    }

    public function upload($directory)
    {
        if ($this->validate()) {
            foreach ($this->images as $image) {
                $image->saveAs($directory . $image->name);
            }
            return true;
        } else {
            return false;
        }
    }
}