<?php

namespace app\controllers;

use app\models\Image;
use app\models\ImageRepository;
use app\models\UploadForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class SiteController extends Controller
{

    /**
     * Displays gallery.
     *
     * @return string
     */
    public function actionIndex()
    {
        $images = new ActiveDataProvider([
            'query' => Image::find(),
            'pagination' => ['pageSize' => 10]
        ]);

        return $this->render('gallery', ['images' => $images]);
    }

    /**
     * Displays add page.
     *
     * @return string
     */
    public function actionAdd()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->images = UploadedFile::getInstances($model, 'images');

            foreach ($model->images as $image) {
                $title = ImageRepository::create($image);
                $image->name = $title;
            }

            if ($model->upload()) {
                $this->redirect('/');
            }
        }
        return $this->render('add', ['model' => $model]);
    }

    /**
     * Displays one image.
     *
     * @return string
     */
    public function actionShow()
    {
        $title = Yii::$app->request->get()['title'];

        return $this->render('_image', ['title' => $title]);
    }
}
