<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property string $dep_id
 * @property string $dep_name
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_name'], 'required'],
            [['dep_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'รหัส',
            'dep_name' => 'ชื่อหน่วยงาน',
        ];
    }
}
