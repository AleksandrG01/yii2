<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SubjectSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subject-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'okato') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'population_rising') ?>

    <?php // echo $form->field($model, 'territory') ?>

    <?php // echo $form->field($model, 'administrative_center') ?>

    <?php // echo $form->field($model, 'gerb') ?>

    <?php // echo $form->field($model, 'imagePath') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
