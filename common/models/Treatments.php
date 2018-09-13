<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "treatments".
 *
 * @property integer $id
 * @property string $treatment_name
 *
 * @property Permits[] $permits
 */
class Treatments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'treatments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['treatment_name'], 'required'],
            [['treatment_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'treatment_name' => 'เพื่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermits()
    {
        return $this->hasMany(Permits::className(), ['treatments_id' => 'id']);
    }
}
