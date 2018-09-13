<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานREFERSโรงพยาบาลม่วงสามสิบ(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(dhdc)</a></div></div>
<p>
    <?=  Html::a('1.รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(Refers)',['refers/referout_all']) ?>
</p>
<p>
  <?= Html::a('2.รายงานRefersส่งต่อแยกตามแผนกบริการ(OPD)',['refers/referopd']) ?>
</p>
<p>
  <?= Html::a('3.รายงานRefersส่งต่อแยกตามแผนกบริการ(IPD)',['refers/referipd']) ?>
</p>
<p>
  <?= Html::a('4.รายงานรับRefers(mBase)',['refers/referin']) ?>
</p>