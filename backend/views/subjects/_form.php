<?php

use backend\models\Status;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\UploadedFile;

/** @var yii\web\View $this */
/** @var backend\models\Subject $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin([
		'id' => 'subject-form',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
	]); ?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
    <?php endif ?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'file')->fileInput() ?>
    <?php endif ?>

    <?= $form->field($model, 'status_id')->dropDownList(
        ArrayHelper::map(Status::find()->all(),'id','status_name'),
        [ 'prompt' => 'Выберите статус...']
    ) ?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'okato')->input('number') ?>
    <?php endif ?>


    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'population')->input('number') ?>
    <?php endif ?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'population_rising')->checkbox() ?>
    <?php endif ?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'territory')->input('number') ?>
    <?php endif ?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <?= $form->field($model, 'administrative_center')->textInput(['maxlength' => true]) ?>
    <?php endif ?>   

    <div class="form-group">
        <?= Html::submitButton( Yii::$app->controller->action->id == "update" ? 'Обновить' : 'Создать' , ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

