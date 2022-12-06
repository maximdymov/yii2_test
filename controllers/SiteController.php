<?php

namespace app\controllers;

use app\models\Image;
use app\models\ImageRepository;
use app\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\BaseInflector;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $images = ImageRepository::getAll();
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
                $imgTitle = ImageRepository::add($image);
                $image->name = $imgTitle;
            }

            if ($model->upload()) {
                $this->redirect('/');
            }
        }
        return $this->render('add', ['model' => $model]);
    }
}
