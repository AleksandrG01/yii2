<?php

use backend\models\Usermodel as User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(
        User::optionsStatus(), [ 'prompt' => 'Выберите статус...']
    ) ?>

    <?= $form->field($model, 'role')->dropDownList(
        User::optionsRoles(), [ 'prompt' => 'Выберите роль...']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
