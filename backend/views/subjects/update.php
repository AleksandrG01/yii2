<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Subject $model */

$this->title = 'Обновить Субьект: ' . $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Все субьекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => ['view', 'id' => $model->id]];
?>
<div class="subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
