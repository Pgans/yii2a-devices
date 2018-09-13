<?php

namespace backend\models;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "permits".
 *
 * @property integer $id
 * @property string $AN
 * @property string $HN
 * @property string $fullname
 * @property integer $treatments_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $status_id
 *
 * @property Person $createdBy
 * @property Status $status
 * @property Treatments $treatments
 */
class Permits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permits';
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
            [['HN', 'fullname', 'treatments_id'], 'required'],
            [['treatments_id', 'created_by', 'updated_by', 'status_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['AN', 'HN'], 'string', 'max' => 7],
            [['fullname'], 'string', 'max' => 150],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['treatments_id'], 'exist', 'skipOnError' => true, 'targetClass' => Treatments::className(), 'targetAttribute' => ['treatments_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'AN' => 'AN',
            'HN' => 'HN',
            'fullname' => 'ชื่อผู้ป่วย',
            'treatments_id' => 'เพื่อ',
            'created_by' => 'ผู้ยืม',
            'created_at' => 'วันที่ยืม',
            'updated_by' => 'ผู้รับคืน',
            'updated_at' => 'วันที่คิน',
            'status_id' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Person::className(), ['user_id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatments()
    {
        return $this->hasOne(Treatments::className(), ['id' => 'treatments_id']);
    }
    public function getUpdater()
    {
        return $this->hasOne(Person::className(), ['user_id' => 'updated_by']);
    }
}
