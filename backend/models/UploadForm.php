<?php 

namespace backend\models;

use yii\base\Model;

class UploadForm extends Model
{
    public $file;
    public $status_id;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'csv', 'mimeTypes' => 'text/csv', 'wrongMimeType'=> \Yii::t('app','Разрешены только файлы с этими расширениями: csv.'),],
            [['status_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'status_id' => 'Статус',
        ];
    }
    
}