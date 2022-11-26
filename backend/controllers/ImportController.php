<?php

namespace backend\controllers;

use backend\models\Subject;
use Yii;
use yii\web\UploadedFile;
use backend\models\UploadForm;
use Faker\Provider\Base;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\MultipleImportStrategy;
use yii\filters\AccessControl;
use yii\web\Controller;

class ImportController extends Controller
{
    public $status_id;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new UploadForm();
        
        if (Yii::$app->request->isPost && $model->load($this->request->post())) {
            
            $this->status_id = $model->status_id;
            $model->file = UploadedFile::getInstance($model, 'file');
            $importer = new CSVImporter();

            $importer->setData(new CSVReader([
                'filename' => $model->file->tempName,
                'fgetcsvOptions' => [
                    'delimiter' => ';'
                ]
            ]));

            $importer->import(new MultipleImportStrategy([
                'tableName' => Subject::tableName(), 
                'configs' => [
                    [
                        'attribute' => 'status_id',
                        'virtual' => true,
                        'value' => function($line) {
                            return $this->status_id;
                        }
                    ],
                    [
                        'attribute' => 'subject',
                        'value' => function($line) {
                            return $line[1];
                        },
                    ],
                    [
                        'attribute' => 'okato',
                        'value' => function($line) {
                            return $line[2];
                        }
            
                    ],
                    [
                        'attribute' => 'population',
                        'value' => function($line) {
                            return $line[3];
                        }
            
                    ],
                    [
                        'attribute' => 'population_rising',
                        'value' => function($line) {
                            return $line[4];
                        }
            
                    ],
                    [
                        'attribute' => 'territory',
                        'value' => function($line) {
                            return $line[5];
                        }
            
                    ],
                    [
                        'attribute' => 'administrative_center',
                        'value' => function($line) {
                            return $line[6];
                        }
            
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($line) {
                            return $line[7];
                        }
            
                    ],

                ],

                'skipImport' => function($line){
                    if(Subject::find()->where(['subject' => $line[1]])->exists()){
                        return true;
                    }
                }  
            ]));

                // $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
                // if ($model->upload()) {
                //     // file is uploaded successfully
                //     return;
                // }
            }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
