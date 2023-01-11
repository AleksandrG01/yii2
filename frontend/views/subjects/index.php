<?php

use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Субъекты Российской Федерации';
?>

<section class="section-subjects --js-section-subjects" >
    <div class="container">
        <?= $this->render('_title') ?>
        <?php Pjax::begin(); ?>
        <?= $this->render('_sorting', ['sort' => $sort, 'sort_name' => array_key_first($sort_name)]) ?>
        <?= $this->render('_subject-items', ['subjects' => $subjects]) ?>
        <?= LinkPager::widget(['pagination' => $pages,]); ?>
        <?php Pjax::end(); ?>
    </div>
</section>
<?= $this->render('_form', ['model' => $subjectForm]) ?>


<script>
	function openCloseSorting() {
		$( '.--js-sorting-open-close' ).toggleClass( "active" );
		$( '.--js-subject-sorting-list' ).toggle();
	}

    function openCloseForm() {
        event.preventDefault();
        $('.success-add-subject').remove();
        $( '.--js-subject-form' ).toggleClass( "-active" ); 
        $( '.--js-section-subjects' ).toggleClass( "-active" );
    }

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