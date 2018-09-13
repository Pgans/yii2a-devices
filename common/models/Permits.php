<?php

namespace frontend\models;

use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "permits".
 *
 * @property integer $id
 * @property string $an
 * @property string $hn
 * @property string $fullname
 * @property integer $treatments_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $status_id
 *
 * @property Treatments $treatments
 * @property Person $createdBy
 * @property Status $status
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
            ],
          //TimestampBehavior::className(),
          BlameableBehavior::className(),
      ];
     }
    public function rules()
    {
        return [
            [['hn', 'fullname', 'treatments_id'], 'required'],
            [['treatments_id', 'created_by', 'updated_by', 'status_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['an', 'hn'], 'string', 'length' => [7,7]],
            [['fullname'], 'string', 'length' => [10,100]],
            [['treatments_id'], 'exist', 'skipOnError' => true, 'targetClass' => Treatments::className(), 'targetAttribute' => ['treatments_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'an' => 'AN',
            'hn' => 'HN',
            'fullname' => 'ชื่อผู้ป่วย',
            'treatments_id' => 'ใช้เพื่อ',
            'created_by' => 'ผู้ยืม',
            'created_at' => 'วันที่ยืม',
            'updated_by' => 'ผู้รับคืน',
            'updated_at' => 'วันที่คืน',
            'status_id' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatments()
    {
        return $this->hasOne(Treatments::className(), ['id' => 'treatments_id']);
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
    
}
