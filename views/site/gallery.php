<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Gallery';
?>
<div class="gallery">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <?php foreach ($images as $image): ?>
                <div class="col-6">
                    <?= Html::img("uploads/$image->title", ['class' => 'img-responsive', 'style' => "width:200px;height:200px;margin:20px"]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>
