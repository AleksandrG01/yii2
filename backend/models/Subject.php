<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "subjects".
 *
 * @property int $id
 * @property int $status_id
 * @property string|null $subject
 * @property int|null $okato
 * @property int|null $population
 * @property int|null $population_rising
 * @property int|null $territory
 * @property string|null $administrative_center
 * @property string|null $gerb
 * @property string|null $imagePath
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Statuses $status
 */
class Subject extends \yii\db\ActiveRecord
{
    public $file;

    public static function tableName()
    {
        return 'subjects';
    }

    public function rules()
    {
        return [
            [['subject', 'okato', 'population', 'population_rising', 'administrative_center', 'territory'], 'required', 'message' => 'Обязательно для заполнения.'],
            [['okato', 'population', 'territory', 'status_id',], 'integer'],
            [['subject', 'administrative_center'], 'string', 'max' => 255],
            ['status_id', 'safe'],
            [
                'file',
                'file',
                'extensions' => 'png, jpg, jpeg',
                'mimeTypes' => 'image/png, image/jpg, image/jpeg',
                'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'status_id' => 'Статус',
            'file' => 'Изображение',
            'subject' => 'Субъект',
            'okato' => 'Окато',
            'population' => 'Население',
            'population_rising' => 'Население растет',
            'territory' => 'Територия',
            'administrative_center' => 'Административный центр',
            'gerb' => 'Герб',
            'created_at' => 'Создание записи',
            'updated_at' => 'Последнее обновление записи',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatuses()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    static function optionsPopulationRising() {
        $values = [
                0 => 'Нет',
                1 => 'Да',
        ];
        return $values;
    }


    public function createSubject()
    {

        $subject                            = new Subject();
        $subject->created_at                = date('Y-m-d h:m:s');
        $subject->status_id                 = $this->status_id;
        $subject->subject                   = $this->subject;
        $subject->okato                     = $this->okato;
        $subject->territory                 = $this->territory;
        $subject->population                = $this->population;
        $subject->population_rising         = $this->population_rising;
        $subject->administrative_center     = $this->administrative_center;

       
        if(!empty($this->file)){
            
            $imageFile  = $this->file;
            $imageName  = time();
            
            if(!file_exists(Url::to('@backend/web/uploads/'))){
                mkdir(Url::to('@backend/web/uploads/'),0777,true);
            }
            
            $PathToimage = Url::to('@backend/web/uploads/') . 'gerb_'.$imageName.'.'.$this->file->extension;
            $imageFile->saveAs($PathToimage);
            $subject->gerb = 'gerb_'.$imageName.'.'.$this->file->extension;
        }

        if ($subject->save()) {
            return $subject->id;
        } else {
          echo "MODEL NOT SAVED";
          print_r($subject->getAttributes());
          print_r($subject->getErrors());
          exit;
        }

    }


    public function updateSubject()
    {
        $subject = Subject::findOne(['id' => $this->id]);
        $subject->updated_at                = date('Y-m-d h:m:s');
        $subject->status_id                 = $this->status_id;
        $subject->subject                   = $this->subject;
        $subject->okato                     = $this->okato;
        $subject->territory                 = $this->territory;
        $subject->population                = $this->population;
        $subject->population_rising         = $this->population_rising;
        $subject->administrative_center     = $this->administrative_center;
        
        
        if(!empty($this->file)){

            if($subject->gerb){
                unlink(Yii::getAlias('@backend/web/uploads/').$subject->gerb);
            }
            
            $imageFile  = $this->file;
            $imageName  = time();
            
            $PathToimage = Url::to('@backend/web/uploads/') . 'gerb_'.$imageName.'.'.$this->file->extension;
            $imageFile->saveAs($PathToimage);
            $subject->gerb = 'gerb_'.$imageName.'.'.$this->file->extension;
        }

        if ($subject->update()) {
            return $subject->id;
        } else {
          echo "MODEL NOT SAVED";
          print_r($subject->getAttributes());
          print_r($subject->getErrors());
          exit;
        }

    }


}
