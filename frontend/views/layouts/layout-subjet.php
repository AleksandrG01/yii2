<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use common\widgets\ActiveForm;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\db\ActiveRecord;

AppAsset::register($this);
?>


<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<body > <?php $this->beginBody() ?>


<div class="wrapper">
    <?= 
        $this->render('//components/_header') 
    ?>
    
    <main class="main">
        <?= $content ?>
    </main>
    
    <?= 
        $this->render('//components/_footer') 
    ?>
</div>

<?= 
    $this->render('//components/_popups') 
?> 

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
