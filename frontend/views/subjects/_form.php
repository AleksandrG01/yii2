<?php
use backend\models\Status;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>


<div class="subject-form-wrapper --js-subject-form">
    
    <svg  class="icon-close-form --js-open-close-form" >
        <use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#pluss" aria-hidden="true"></use>
	</svg>
    <?php Pjax::begin(); ?>

    <?= $this->render('_success-create') ?>

    <div class="h2">Добавить</div>

    <?php $form = ActiveForm::begin([
            'id' => 'subject-form',
            'options' => [
                'enctype' => 'multipart/form-data',
                'data-pjax' => true,
            ],
        ]); ?>

        <div class="form-group" >
            <?= $form->field($model, 'file', [
                    'template' => "
                        <input type='file' name='Subject[file]' id='subject-file' accept='image/*' onchange='setImage(this)'>\n
                        <span class='image-plaseholder'>Добавить <br> герб</span>\n
                        <img id='image-preview' src='#' alt='' />\n
                        <span class='clearImage --js-clear-image-subject'>\n
                            <svg>
                                <use xlink:href='/images/svg-sprite/symbol/svg/sprite.symbol.svg#trash' aria-hidden='true'></use>
                            </svg>
                        </span>\n
                        {error}",
                    'options' => ['class' => 'imgSelect _pic-fluid', 'tag' => 'label', 'for' => 'subject-file'],
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

    <?php Pjax::end(); ?>
    </div>



    <script>

        function setImage(image){
            let file = image.files[0];
            console.log($('#imgSelect'));
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#image-preview")
                    .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);

                let clearSpanicon = document.querySelectorAll('.--js-clear-image-subject');
                $(clearSpanicon).addClass( "-active" );
                $( clearSpanicon ).click(function() {
                    $("#image-preview").attr("src", "");
                    $('#imgSelect').val("");
                    $(clearSpanicon).removeClass( "-active" );
                    file = null;
                });
            }
        }

    </script>