<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Subject $model */

$this->title = 'Создать субьект';
$this->params['breadcrumbs'][] = ['label' => 'Субьекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
