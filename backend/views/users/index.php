<?php

use backend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->changeTextStatus($model->status);
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', User::optionsStatus() ,['class'=>'form-control','prompt' => 'Выберите статус']),
            ],
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return $model->changeTextRoles($model->role);
                },
                'filter' => Html::activeDropDownList($searchModel, 'role', User::optionsRoles() ,['class'=>'form-control','prompt' => 'Выберите роль']),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
