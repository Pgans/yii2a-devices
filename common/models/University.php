<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "university".
 *
 * @property integer $university_id
 * @property string $university_name
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_name'], 'required'],
            [['university_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'university_id' => 'รหัสวิทยาลัย',
            'university_name' => 'ชื่อมหาวิทยาลัย',
        ];
    }
}
