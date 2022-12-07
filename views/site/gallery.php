<?php

/** @var yii\web\View $this */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Gallery';
?>
<div class="gallery">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $images,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a($data->title, "/show?title=$data->title");
                        }
                    ],
                    [
                        'label' => 'Preview',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::img("uploads/$data->title", ["width" => "50px"]);
                        }
                    ],
                    'time'
                ]
            ]) ?>
        </div>
    </div>


</div>
