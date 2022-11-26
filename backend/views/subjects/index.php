<?php

use backend\models\Status;
use backend\models\Subject;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
/** @var yii\web\View $this */
/** @var backend\models\SubjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Все субьекты Российской Федерации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>
        <p>
            <?= Html::a('Создать Субьект', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Пакетное добавление из файла CSV', ['/import'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif ?>   

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subject',
            [
                'attribute' => 'population_rising',
                'value' => function ($model) {
                    return $model->population_rising === 1 ? 'Да':'Нет';
                },
                'filter' => Html::activeDropDownList($searchModel, 'population_rising', Subject::optionsPopulationRising() ,['class'=>'form-control','prompt' => 'Выберите опцию']),
            ],
            [
                'attribute' => 'status_id',
                'filter' => Html::activeDropDownList($searchModel, 'status_id', ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'status_name') ,['class'=>'form-control','prompt' => 'Выберите Статус']),
                'value' => function ($model) {
                    return $model->statuses->status_name;
                },
            ],
            // 'statuses.status_name',
            // [
            //     'attribute' => 'Изображение',
            //     'format' => 'html',
            //     'value' => function ($model) {
            //         return Html::img(Yii::getAlias('/backend/web/uploads/'. $model->gerb),
            //             ['width' => '30px',
            //             'alt'   => $model->subject,]);
            //     },
            // ],
            'created_at',
            // [
            //     'attribute' => 'created_at',
            //     'value' => 'created_at',
            //     'format' => 'raw',
            //     'filter' => DatePicker::widget([
            //         'model' => $searchModel,
            //         'attribute' => 'created_at',
            //         'clientOptions' => [
            //             'autoclose' => true,
            //             'format' => 'yyyy-mm-dd'
            //         ]
            //     ]),
            // ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Subject $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>