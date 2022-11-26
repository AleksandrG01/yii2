<?php

namespace frontend\controllers;

use backend\models\Subject;
use Yii;
use yii\data\Pagination;
use yii\data\Sort;
use yii\helpers\Url;
use yii\web\UploadedFile;

class SubjectsController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $this->layout = 'layout-subjet';

        $query = Subject::find();
        $subjectForm = new Subject;

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 5,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $sort = new Sort([
            'attributes' => [
                'territory'=> [
                    'label' => 'Територии',
                ],
                'population'=> [
                    'label' => 'Населению',
                ],
                'okato' => [
                    'label' => 'Окато',
                ],
            ],
        ]);

        
    
        $subjects = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sort->orders)
            ->all();


        if ($subjectForm->load(Yii::$app->request->post()) && $subjectForm->validate() && Yii::$app->request->isPjax) {
            
            $subjectForm->file = UploadedFile::getInstance($subjectForm, 'file');

            if($subjectForm->createSubject()){

                Yii::$app->session->setFlash('success');

                $subjectForm = new Subject;

            }
        }
    
        return $this->render('index', [
             'subjects' => $subjects,
             'pages' => $pages,
             'sort' => $sort,
             'sort_name' => $sort->orders,
             'subjectForm' => $subjectForm,
        ]);

    }

    static function textSorting($text) {
        switch ($text) {
            case 'territory':
                return 'Територии';
                break;
            case 'population':
                return 'Населению';
                break;
            case 'okato':
                return 'Окато';
                break;
          }
    }

}
