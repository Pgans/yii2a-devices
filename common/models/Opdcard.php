<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "opdcard".
 *
 * @property integer $idopdcard
 * @property string $an
 * @property string $hn
 * @property integer $person_user_id
 * @property string $telephone
 * @property string $borrow_date
 * @property string $pay_date
 * @property integer $admin_id
 * @property string $receives
 * @property string $receives_date
 * @property integer $status_id
 *
 * @property Admin $admin
 * @property Person $personUser
 * @property Status $status
 */
class Opdcard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opdcard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hn', 'person_user_id', 'borrow_date', 'pay_date', 'admin_id', 'status_id'], 'required'],
            [['person_user_id', 'admin_id', 'status_id'], 'integer'],
            [['borrow_date', 'pay_date', 'receives_date'], 'safe'],
            [['an', 'hn'], 'string', 'max' => 6],
            [['telephone'], 'string', 'max' => 10],
            [['receives'], 'string', 'max' => 100],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['person_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_user_id' => 'user_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idopdcard' => 'Idopdcard',
            'an' => 'เลขผู้ป่วยใน',
            'hn' => 'เลขผู้ป่วยนอก',
            'person_user_id' => 'ผู้ยืม',
            'telephone' => 'เบอร์โทร',
            'borrow_date' => 'วันที่ยืม',
            'pay_date' => 'วันที่จ่าย',
            'admin_id' => 'ผู้จ่าย',
            'receives' => 'ผู้รับคืน',
            'receives_date' => 'Receives Date',
            'status_id' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonUser()
    {
        return $this->hasOne(Person::className(), ['user_id' => 'person_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
