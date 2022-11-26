<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'role'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'role' => 'Роль',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    
    static function optionsRoles() {
        $values = [
                1 => 'Админ',
                2 => 'Менеджер',
                3 => 'Гость',
        ];
        return $values;
    }

    static function optionsStatus() {
        $values = [
                0 => 'Удален',
                9 => 'Неактивирован',
                10 => 'Активирован',
        ];
        return $values;
    }


    static function changeTextRoles($role_id) {

        switch ($role_id) {
            case 1:
                return 'Админ';
                break;
            case 2:
                return 'Менеджер';
                break;
            case 3:
                return 'Гость';
                break;
        }
        
    }

    static function changeTextStatus($status) {

        switch ($status) {
            case 0:
                return 'Удален';
                break;
            case 9:
                return 'Неактивирован';
                break;
            case 10:
                return 'Активирован';
                break;
        }
        
    }
}
