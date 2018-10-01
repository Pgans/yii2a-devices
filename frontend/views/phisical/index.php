<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานกายภาพบำบัดโรงพยาบาลม่วงสามสิบ</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้()</a></div></div>
<p>
    <?=  Html::a('1.ผู้สั่งทำหัตถการกายภาพบำบัดในสถานบริการ',['phisical/operation_phisical_in']) ?>
</p>
<p>
    <?=  Html::a('2.หัตถการกายภาพแยกรายเดือนและProvider',['phisical/operation_month']) ?>
</p>
<p>
    <?=  Html::a('3.หัตถการกายภาพแยกตามสิทธิการรักษา',['phisical/operation_inscl']) ?>
</p>

