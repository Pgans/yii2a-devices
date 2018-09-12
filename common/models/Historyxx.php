<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $devices_device_id
 * @property integer $dep_id
 * @property integer $user_id
 * @property string $created_at
 *
 * @property Devices $devicesDevice
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['devices_device_id', 'dep_id', 'user_id'], 'required'],
            [['devices_device_id', 'dep_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['devices_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['devices_device_id' => 'device_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'devices_device_id' => 'รหัสอุปกรณ์',
            'departments.dep_id' => 'แผนกที่ย้าย',
            'user_id' => 'ผู้ใช้งาน',
            'created_at' => 'ย้ายเมื่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesDevice()
    {
        return $this->hasOne(Devices::className(), ['device_id' => 'devices_device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getDepartments()
    {
        return $this->hasOne(Departments::className(), ['dep_id' => 'dep_id']);
    }
}
