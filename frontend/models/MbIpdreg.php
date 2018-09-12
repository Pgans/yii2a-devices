<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mb_ipdreg".
 *
 * @property integer $YYYY
 * @property integer $MM
 * @property string $HN
 * @property string $CID
 * @property string $VISIT_ID
 * @property string $ADM_ID
 * @property string $ADM_DT
 * @property string $DSC_DT
 * @property integer $DSC_TYPE
 * @property integer $DSC_STATUS
 * @property string $UNIT_ID
 * @property string $UNIT_NAME
 * @property string $DSC_DR
 * @property string $ADM_DR
 * @property string $P_DIAG
 * @property string $ADJRW
 * @property string $RW
 */
class MbIpdreg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mb_ipdreg';
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
            [['YYYY', 'MM', 'DSC_TYPE', 'DSC_STATUS'], 'integer'],
            [['HN', 'CID', 'VISIT_ID', 'ADM_ID', 'ADM_DT', 'DSC_DT', 'DSC_TYPE', 'DSC_STATUS', 'UNIT_ID', 'UNIT_NAME', 'DSC_DR', 'ADM_DR', 'P_DIAG', 'ADJRW', 'RW'], 'required'],
            [['ADM_DT', 'DSC_DT'], 'safe'],
            [['P_DIAG'], 'string'],
            [['ADJRW', 'RW'], 'number'],
            [['HN', 'ADM_ID'], 'string', 'max' => 6],
            [['CID'], 'string', 'max' => 13],
            [['VISIT_ID'], 'string', 'max' => 10],
            [['UNIT_ID'], 'string', 'max' => 2],
            [['UNIT_NAME'], 'string', 'max' => 40],
            [['DSC_DR', 'ADM_DR'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'YYYY' => 'Yyyy',
            'MM' => 'Mm',
            'HN' => 'Hn',
            'CID' => 'Cid',
            'VISIT_ID' => 'Visit  ID',
            'ADM_ID' => 'Adm  ID',
            'ADM_DT' => 'Adm  Dt',
            'DSC_DT' => 'Dsc  Dt',
            'DSC_TYPE' => 'Dsc  Type',
            'DSC_STATUS' => 'Dsc  Status',
            'UNIT_ID' => 'Unit  ID',
            'UNIT_NAME' => 'Unit  Name',
            'DSC_DR' => 'Dsc  Dr',
            'ADM_DR' => 'Adm  Dr',
            'P_DIAG' => 'P  Diag',
            'ADJRW' => 'Adjrw',
            'RW' => 'Rw',
        ];
    }
}
