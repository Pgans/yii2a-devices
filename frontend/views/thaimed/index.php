<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานแพทย์แผนไทย(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
    <?=  Html::a('1.นับการทำหัตถการแพทย์ทางเลือก',['thaimed/operation']) ?>
</p>
<!-- <p>
   <?= Html::a('2.นับการทำหัตถการแพทย์แผนไทย (แยกรายเดือน)', ['thaimed/operation_month'])?>
</p> -->
<!-- <p>
  <?= Html::a('3.นับผู้ป่วยนอกสถานบริการ(แพทย์ทางเลือก)',['thaimed/outstan']) ?>
</p> -->
<p>
  <?=  Html::a('2.รายงานการจ่ายยาสมุนไพรฟ้าทะลายโจรในคนที่เป็นโรครหัสJ00-J99',['thaimed/cormore']) ?>
</p>
<p>
  <?=  Html::a('3.รายงานการจ่ายยาสมุนไพรทดแทน 6 ชนิด (แยกรายเดือน)',['thaimed/smonpri_replace']) ?>
</p>
<!-- <p>
  <?=  Html::a('6.รายงานผู้สั่งหัตการแผทย์แผนไทย(ผู้สั่ง)',['thaimed/staff_operation']) ?>
</p> -->
<p>
  <?=  Html::a('4.รายงานผู้ทำหัตการแผทย์แผนไทยแยกตามผู้ทำหัตการ(ผู้ทำ)',['thaimed/surgeon_operation']) ?>
</p>
<p>
  <?=  Html::a('5.ตรวจสอบรหัสหัตการแพทย์แผนไทยกับรหัสมาตรฐาน43แฟ้ม',['thaimed/check_operations']) ?>
</p>
<p>
  <?=  Html::a('6.ตรวจสอบรหัสหัตการแพทย์แผนไทย(9007810)',['thaimed/surgeon_9007810']) ?>
</p>
<p>
  <?= Html::a('7.รหัสโรคแพทย์แผนไทยประเภทU(ยกเว้นU778)',['thaimed/u_thaimed'])?>
</p>