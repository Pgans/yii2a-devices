<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property integer $dep_id
 * @property string $dep_name
 *
 * @property Person[] $people
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
            [['dep_name'], 'string', 'max' => 100],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['dep_id' => 'dep_id']);
    }
}
