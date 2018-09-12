<?php

namespace common\models;

use Yii;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $devices_device_id
 * @property integer $departments_dep_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Devices $devicesDevice
 * @property User $createdBy
 * @property Departments $departmentsDep
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
      public function behaviors()
     {
      return [
       
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
          BlameableBehavior::className(),
      ];
     }
    public function rules()
    {
        return [
            [['devices_device_id', 'departments_dep_id'], 'required'],
            [['devices_device_id', 'departments_dep_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['devices_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['devices_device_id' => 'device_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['departments_dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['departments_dep_id' => 'dep_id']],
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
            'departments_dep_id' => 'แผนกที่ย้าย',
            'created_by' => 'ผู้ย้าย',
            'created_at' => 'ย้ายเมื่อ',
            'updated_by' => 'ผู้แก้ไข',
            'updated_at' => 'แก้ไขเมื่อ',
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentsDep()
    {
        return $this->hasOne(Departments::className(), ['dep_id' => 'departments_dep_id']);
    }
}
