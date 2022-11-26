<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string|null $status_name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Subject[] $subjects
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_name' => 'Название статуса',
        ];
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['status_id' => 'id']);
    }
}
