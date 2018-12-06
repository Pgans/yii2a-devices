<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานยาเสพติด-จิตเวช(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
  <?= Html::a('1.รายชือผู้ป้วยที่มีรหัสโรค F11-F16และF18-F19 (คน)',['addictive/mental']) ?>
</p>
<p>
  <?= Html::a('2.รายงานผู้ป้วยโรคซึมเศร้า F320-F329(คน)',['addictive/depress']) ?>
</p>
<p>
  <?= Html::a('3.รายงานพัฒนาการเด็กสมวัยอายุ 6-12 ปีแยกตามตำบลและช่วงอายุ ในเขตอำเภอม่วงสามสิบ',['addictive/specailpp'])?>
</p>



