<?php

namespace frontend\models;

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
 * @property integer $dep_id
 * @property integer $positions_id
 *
 * @property Permits[] $permits
 * @property Departments $dep
 * @property Positions $positions
 * @property User $user
 */
class Person extends \yii\db\ActiveRecord
{
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
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['dep_id' => 'dep_id']],
            [['positions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::className(), 'targetAttribute' => ['positions_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermits()
    {
        return $this->hasMany(Permits::className(), ['created_by' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
