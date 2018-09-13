<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $photo
 * @property string $birthdate
 * @property string $start_date
 * @property string $stop_date
 * @property string $dep_id
 * @property integer $positions_id
 *
 * @property User $user
 * @property Departments $dep
 * @property Positions $positions
 */
class Person extends \yii\db\ActiveRecord
{
  public $person_img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'firstname', 'lastname', 'birthdate', 'start_date', 'stop_date', 'dep_id', 'positions_id'], 'required'],
            [['user_id', 'dep_id', 'positions_id'], 'integer'],
            [['birthdate', 'start_date', 'stop_date'], 'safe'],
            [['firstname', 'lastname', 'photo'], 'string', 'max' => 100],
            [['person_img'], 'file','skipOnEmpty'=>true, 'on'=> 'update', 'extensions' =>'jpg, png, gif']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'รหัสบุคคล',
            'firstname' => 'ชื่อ',
            'lastname' => 'นามสกุล',
            'photo' => 'รูปภาพ',
            'birthdate' => 'วันเกิด',
            'start_date' => 'วันย้ายเข้า',
            'stop_date' => 'วันย้ายออก',
            'dep_id' => 'แผนก',
            'positions_id' => 'ตำแหน่ง',
            'person_img' => 'รูปภาพ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     public function getDepartment()
     {
         return $this->hasOne(Departments::className(), ['dep_id' => 'dep_id']);
     }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasOne(Positions::className(), ['id' => 'positions_id']);
    }
}
