<?php
use backend\models\Status;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>

<div class="subject-form-wrapper" x-data :class="$store.openForm.on && '-active'">

	<svg  class="icon-close-form"  x-data @click.prevent="$store.openForm.closeForm()">
		<use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#pluss" aria-hidden="true"></use>
	</svg>

    <?= $this->render('_success-create') ?>

    <div class="h2">Добавить</div>

    <?php $form = ActiveForm::begin([
            'id' => 'subject-form',
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-pjax' => true,
            ],
        ]); ?>

        <div x-data="imgPreview" x-cloak class="form-group" >
            <?= $form->field($model, 'file', [
                    'template' => "
                        <input type='file' id='subject-file' name='Subject[file]' accept='image/*' x-ref='myFile' @change='previewFile'>\n
                        <span class='image-plaseholder'>Добавить <br> герб</span>\n
                        <template x-if='imgsrc'><img :src='imgsrc'></template>\n
                        <span class='clearImage' @click='clearFile' x-bind:class='{\"-active\": showedImage()}'>\n
                            <svg>
                                <use xlink:href='/images/svg-sprite/symbol/svg/sprite.symbol.svg#trash' aria-hidden='true'></use>
                            </svg>
                        </span>\n
                        {error}",
                    'options' => ['class' => 'imgSelect _pic-fluid', 'tag' => 'label', 'for' => 'subject-file', 'x-bind:class' => '{ \'-active\': showedImage()}'],
                ])->fileInput([], false) ?>
        </div>

        <div class="row">
			<div class="col-8">
                <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-4">
                <?= $form->field($model, 'okato')->input('number') ?>
			</div>
			<div class="col-12">
                <?= $form->field($model, 'administrative_center')->textInput(['maxlength' => true]) ?>
			</div>
		</div>

        <div class="row">
			<div class="col-6">
                <?= $form->field($model, 'population')->input('number') ?>
			</div>
			<div class="col-6 _align-center">
				<span class="_align-right switch-lable">Население растёт</span>
                <?= $form->field($model, 'population_rising', [
                    'template' => "{label}\n{input}\n<div class='slider round'></div>\n{error}{label}",
                    'options' => ['class' => 'form-group -switch', 'tag' => 'label', 'for' => 'subject-population_rising'],
                ])->checkbox(['label' => null]) ?>
			</div>
		</div>

        <div class="row">
			<div class="col-6">
                <?= $form->field($model, 'territory')->input('number') ?>
			</div>
		</div>

        <div class="form-group">
            <?= Html::submitButton( 'Добавить' , ['class' => 'button -red-bg']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

<?php Pjax::end(); ?>


