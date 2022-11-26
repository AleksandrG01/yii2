<?php

use backend\models\Status;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Импорт CSV';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-index">

<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
    ]) ?>

    <?= $form->field($model, 'status_id')->dropDownList(
        ArrayHelper::map(Status::find()->all(),'id','status_name'),
        [ 'prompt' => 'Выберите статус...']
    )->hint('По умолчанию (будет установлен для всего импорта)') ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <button class="btn btn-success">Загрузить</button>

<?php ActiveForm::end() ?>


</div>