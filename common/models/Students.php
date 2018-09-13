<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property integer $stud_id
 * @property string $fullname
 * @property string $address
 * @property string $email
 * @property string $tel
 * @property integer $faculty_id
 * @property integer $university_id
 * @property string $train_at
 * @property string $traint_out
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stud_id', 'fullname', 'address', 'email', 'faculty_id', 'university_id', 'train_at', 'traint_out'], 'required'],
            [['stud_id', 'faculty_id', 'university_id'], 'integer'],
            [['train_at', 'traint_out'], 'safe'],
            [['fullname', 'address'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'stud_id' => 'รหัสนักศึกษา',
            'fullname' => 'ชื่อเต็ม',
            'address' => 'ที่อยู่',
            'email' => 'อีเมล์',
            'tel' => 'เบอร์โทร',
            'faculty_id' => 'ชื่อสาขา-คณะ',
            'university_id' => 'ชื่อมหาวิทยาลัย',
            'train_at' => 'วันทีเข้าฝึก',
            'traint_out' => 'วันที่ฝึกเสร็จ',
        ];
    }
    public function getFaculty() {
      return $this->hasOne(Faculty::className(), ['faculty_id'=> 'faculty_id']);
    }
    public function getUniversity() {
      return $this->hasOne(University::className(), ['university_id'=> 'university_id']);
    }
}
