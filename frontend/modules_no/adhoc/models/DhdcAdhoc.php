<?php

namespace modules\adhoc\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dhdc_adhoc".
 *
 * @property integer $id
 * @property string $title
 * @property string $sql_report
 * @property string $date_begin
 * @property string $date_end
 * @property string $type
 * @property string $note1
 * @property string $note2
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class DhdcAdhoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhdc_adhoc';
    }
    public function behaviors() {
        return [
            [
                'class'=>  BlameableBehavior::className()
            ],
            [
                'class'=>  TimestampBehavior::className(),
                'value'=> new \yii\db\Expression("NOW()")
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'],'required'],
            [['sql_report'], 'string'],
            [['date_begin', 'date_end', 'created_at', 'updated_at'], 'safe'],
            [['type','note1','note2', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อรายงาน',
            'sql_report' => 'คำสั่ง SQL',
            'date_begin' => 'วันที่เริ่ม',
            'date_end' => 'วันที่สิ้นสุด',
            'type'=>'ประเภท',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'อัพเดท',
            'updated_by' => 'Updated By',
        ];
    }
}
