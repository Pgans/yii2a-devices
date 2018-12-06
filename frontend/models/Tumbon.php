<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "tumbon".
 *
 * @property int $town_id
 * @property string $town_name
 */
class Tumbon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tumbon';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['town_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'town_id' => 'Town ID',
            'town_name' => 'Town Name',
        ];
    }
}
