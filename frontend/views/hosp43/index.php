<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงาน43แฟ้มโรงพยาบาลม่วงสามสิบ(dhdc)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(dhdc)</a></div></div>
<p>
    <?=  Html::a('1.นับเพศชายแต่มาANC(43F)',['hosp43/ancman']) ?>
</p>
<p>
  <?= Html::a('2.คนเสียชีวิตมารับบริการ(43F)',['hosp43/servicesdeaths']) ?>
</p>
<p>
  <?= Html::a('3.รายงานเด็กทารกส่งสำนักงานงานสาธารณสุขจังหวัดอุบลราชธานี(43F)',['hosp43/newborn_ssj']) ?>
</p>
<p>
  <?= Html::a('4.รายงานคนเสียชีวิตในโรงพยาบาล(43F)',['hosp43/death_all']) ?>
</p>
<p>
  <?= Html::a('5.รายงานประชากรที่มีอายุมากกว่่า100 ปี',['hosp43/person100'])?>
</p>
<p>
  <?= Html::a('6.รายงานเด็กทารกที่คลอดในโรงพยาบาล',['hosp43/newborn43'])?>
</p>
<p>
  <?= Html::a('7.จำนวนเด็กทารกที่มีน้ำหนักน้อยกว่า1000กรัม หรือมากกว่า4000กรัม',['hosp43/bweight'])?>
</p>
<p>
  <?= Html::a('8.ผู้มารับบริการANCที่มีผลผิดปกติ(ancresult=2)',['hosp43/ancresult'])?>
</p>
<p>
  <?= Html::a('9.xxxxxxxxxxxxxxxxxxxxxx',['hosp43/xxxxxxxxxxx'])?>
</p>