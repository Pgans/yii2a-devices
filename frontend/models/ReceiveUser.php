<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "receive_user".
 *
 * @property integer $id
 * @property string $fullname
 *
 * @property Permits[] $permits
 */
class ReceiveUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receive_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname'], 'required'],
            [['fullname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'ชื่อสกุล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermits()
    {
        return $this->hasMany(Permits::className(), ['receive_user_id' => 'id']);
    }
}
