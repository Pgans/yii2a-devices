<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property integer $device_id
 * @property string $device_serial
 * @property string $device_name
 * @property integer $category_id
 * @property integer $dep_id
 * @property string $spec
 * @property string $purchase_date
 * @property string $due_date
 * @property integer $price
 * @property string $sale_date
 * @property string $orther
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_serial', 'device_name', 'category_id', 'dep_id', 'spec', 'purchase_date', 'due_date', 'price'], 'required'],
            [['category_id', 'dep_id', 'price'], 'integer'],
            [['purchase_date', 'due_date', 'sale_date'], 'safe'],
            [['device_serial'], 'string', 'max' => 20],
            [['device_name'], 'string', 'max' => 50],
            [['spec', 'orther'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => 'รหัสอุปกรณ์',
            'device_serial' => 'หมายเลขครุภัณฑ์',
            'device_name' => 'ชื่ออุุปกรณ์',
            'category_id' => 'รหัสประเภทอุปกรณ์',
            'dep_id' => 'รหัสแผนก',
            'spec' => 'รุ่น ยี่ห้อ',
            'purchase_date' => 'วันที่ซื้อ',
            'due_date' => 'วันครบกำหนด',
            'price' => 'ราคา',
            'sale_date' => 'วันจำหน่าย',
            'orther' => 'หมายเหตุ',
        ];
    }
    public function getDepartments() {
      return $this->hasOne(Departments::className(),['dep_id'=>'dep_id']);
    }
    public function getCategories() {
      return $this->hasOne(Categories::className(), ['category_id' => 'category_id']);
    }
}
