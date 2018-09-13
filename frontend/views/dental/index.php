<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานทันตกรรม(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
  <?= Html::a('1.นับผู้มารับบริการทันตกรรม(นอก)',['thaimed/outstan']) ?>
</p>
<p>
  <?= Html::a ('2.รายงานสอนแปรงฟันเด็ก0-2ปี(2338610)',['dental/brush'])?>
</p>
<p>
  <?= Html::a('3.ผู้มารับบริการทันตกรรมอายุมากกว่า60ปี',['dental/reg_dent'])?>
</p>
<p>
  <?= Html::a('4.xxxxxxxxxxxxxxxxx',['dental/old60'])?>
</p>

