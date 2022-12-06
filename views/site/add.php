
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Adding images';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'images/*']) ?>
<button>Submit</button>

<?php ActiveForm::end() ?>
