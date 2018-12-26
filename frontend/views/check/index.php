<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
?>
<h1><a>ตรวจสอบการถ่ายโอนข้อมูลระหว่างSERVER รายวัน</a></h1>
<div>*** ****</div>
<?php $form = ActiveForm::begin([ ]);
    echo Html::a('ตรวจสอบVisit-IPD', ['check/check_ipdvisit'], ['class' => 'btn btn-danger', 'id'=>'modalButton','target'=>'_blank']);
    echo Html::a('ตรวจสอบVisit-OPD', ['check/check_opdvisit'], ['class' => 'btn btn-info', 'id'=>'modalButton','target'=>'_blank']);
    //echo Html::a('รหัสที่ไม่เข้า43แฟ้ม', ['thaimed/no_procudure'], ['class' => 'btn btn-warning', 'style' => 'margin-left:px','target'=>'_blank']);
    //echo Html::a('เปรียบเทียบ', ['thaimed/surgeon_inout'], ['class' => 'btn btn-info', 'style' => 'margin-left:5px','target'=>'_blank']);
    ActiveForm::end();?>
