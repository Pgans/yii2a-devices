<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $store_id
 * @property string $store_name
 * @property string $address
 * @property string $tel
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_name', 'address', 'tel'], 'required'],
            [['store_name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 200],
            [['tel'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => 'รหัส',
            'store_name' => 'ชื่อร้าน',
            'address' => 'ที่อยู่',
            'tel' => 'เบอร์โทร',
        ];
    }
}
