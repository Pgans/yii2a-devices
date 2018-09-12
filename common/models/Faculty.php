<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property integer $faculty_id
 * @property string $faculty_name
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_name'], 'required'],
            [['faculty_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faculty_id' => 'รหัสคณะวิชา',
            'faculty_name' => 'ชื่อคณะวิชา',
        ];
    }
}
