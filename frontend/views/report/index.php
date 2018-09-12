<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานเวชระเบียน(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
    <?=  Html::a('1.รายงานผู้ป่วยในDischarge',['report/dsc59']) ?>
</p>
<p>
  <?= Html::a('2.รายงานผู้ป่วยส่งต่อ(สูงกว่าภายในจังหวัด)',['report/referout59']) ?>
</p>
<p>
  <?= Html::a('3.รายงาน10อันดับโรคOPD',['report/dxopd59'])?>
</p>
<p>
  <?= html::a('4.รายงาน10อันดับโรคIPD',['report/dxipd'])?>
</p>
<p>
  <?= html::a('5.รายงาน10อันดับโรคIPD(ipd_reg)',['report/dxipd_reg'])?>
</p>
<p>
  <?=  Html::a('6.รายงานผู้ป่วยนอกมารับบริการแยกตามแผนกที่ลงทะเบียน',['report/rpt_dep59']) ?>
</p>
<p>
 <?=  Html::a('8.รายงานผู้มารับบริการผู้ป่วยใน (ipd_reg)',['report/visits_ipd']) ?>
</p>
<p>
<?=  Html::a('9.รายงานผู้มารับบริการผู้ป่วยนอก(opd_visits)',['report/visits_opd']) ?>
</p>
<p>
<?=  Html::a('12.รายงานนับการทำหัตการนับเรียงตามลำดับโรค (operation)',['report/operation']) ?>
</p>
<p>
<?=  Html::a('13.รายงานออกหน่วยนอกสถานบริการ (mobile)',['report/outstan']) ?>
</p>
<p>
<?=  Html::a('14.รายงาน5อันดับโรคตรวจโรคทั่วไป (mb_visitsdx)',['report/examination']) ?>
</p>
<p>
<?=  Html::a('15.รายงาน5อันดับโรคอุบัติเหตุฉุกเฉิน (mb_visitsdx)',['report/er5dx']) ?>
</p>



<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-success">รายงานส่ง43แฟ้ม(HDC)</a></div>
</div>

<p>
<div class="row">

<div class = "col-sm-4"> <a href ="" class="btn btn-danger">รายงานส่ง43แฟ้ม(mBase)</a></div>
</div>
