<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานแพทย์แผนไทย(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
    <?=  Html::a('1.นับการทำหัตถการแพทย์ทางเลือกในโรงพยาบาล',['thaimed/operation']) ?>
</p>
<p>
   <?= Html::a('2.นับการทำหัตถการแพทย์แผนไทย (แยกรายเดือน)', ['thaimed/operation_month'])?>
</p>
<p>
  <?= Html::a('3.นับผู้ป่วยนอกสถานบริการ(แพทย์ทางเลือก)',['thaimed/outstan']) ?>
</p>
<p>
  <?=  Html::a('4.รายงานการจ่ายยาสมุนไพรฟ้าทะลายโจรในคนที่เป็นโรครหัสJ00-J99',['thaimed/cormore']) ?>
</p>
<p>
  <?=  Html::a('5.รายงานการจ่ายยาสมุนไพรทดแทน 6 ชนิด (แยกรายเดือน)',['thaimed/smonpri_replace']) ?>
</p>