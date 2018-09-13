<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "serviceout".
 *
 * @property integer $id
 * @property integer $device_id
 * @property string $symptom
 * @property string $date_sent
 * @property string $date_in
 * @property string $price
 * @property string $orther
 * @property integer $store_id
 */
class Serviceout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'serviceout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'symptom', 'date_sent', 'store_id'], 'required'],
            [['device_id', 'store_id'], 'integer'],
            [['date_sent', 'date_in'], 'safe'],
            [['symptom', 'price', 'orther'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'device_id' => 'ชื่ออุปกรณ์',
            'symptom' => 'อาการ',
            'date_sent' => 'วันที่ส่งออก',
            'date_in' => 'วันที่รับมา',
            'price' => 'ราคาซ่อม',
            'orther' => 'สิ่งที่ซ่อม',
            'store_id' => 'ชื่อร้านค้า',
        ];
    }
    public function getDevice() {
      return $this->hasOne(Devices::className(), ['device_id'=>'device_id']);
    }
    public function getStore() {
      return $this->hasOne(Store::className(), ['store_id'=>'store_id']);
    }
}
