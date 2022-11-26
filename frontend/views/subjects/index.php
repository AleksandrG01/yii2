
<?php

use yii\widgets\LinkPager;
use yii\widgets\Pjax;
$this->title = 'Субъекты Российской Федерации';
?>




<section class="section-subjects" x-data :class="$store.openForm.on && '-active'">
	<div class="container">
                <?= $this->render('_title') ?>
                <?php Pjax::begin(); ?>
                        <?= $this->render('_sorting', ['sort' => $sort, 'sort_name' => array_key_first($sort_name) ]) ?>
                        <?= $this->render('_subject-items', ['subjects' => $subjects]) ?>
                        <?= LinkPager::widget(['pagination' => $pages,]); ?>
                <?php Pjax::end(); ?>
	</div>
</section>
<?= $this->render('_form', ['model' => $subjectForm]) ?>