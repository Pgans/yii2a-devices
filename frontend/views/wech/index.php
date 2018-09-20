<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานเวชปฏิบัติ</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
    <?=  Html::a('1.รายงานมารับบริการแผนกหอบหืด(J45-J46)',['wech/asthma']) ?>
</p>
<p>
   <?= Html::a('2.xxxxxxxxxxxxxxxxxxxxxx', ['wech/operation_month'])?>
</p>
<p>
  <?= Html::a('3.xxxxxxxxxxxxxxxxxxxx',['wech/outstan']) ?>
</p>
