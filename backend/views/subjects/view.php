<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Status;

/** @var yii\web\View $this */
/** @var backend\models\Subject $model */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Субьекты РФ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subject-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject',
            [
                'attribute'=>'Статус субьекта',
                'value'=>$model->statuses->status_name,
            ],
            'okato',
            'population',
            [
                'attribute' => 'Население растет',
                'value'=> $model->population_rising == 1 ? 'Да':'Нет',
            ],
            'territory',
            'administrative_center',
            [
                'attribute' => 'Изображение',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Yii::getAlias('/backend/web/uploads/'. $model->gerb),
                        ['width' => '30px',
                        'alt'   => $model->subject,]);
                },
            ],
            'created_at',
            'updated_at',
        ],

    ]) ?>

</div>
