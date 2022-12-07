<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Showing image';
?>
<div class="text-center">
    <h1> <?= $title ?> </h1>
    <?= Html::img("uploads/$title", ['max-width' => '100%']) ?>
</div>


