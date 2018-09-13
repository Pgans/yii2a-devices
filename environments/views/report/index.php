<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานเวชระเบียน</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">ปีงบประมาณ2559</a></div></div>
<p>
    <?=  Html::a('1.รายงานผู้ป่วยในDischarge',['report/dsc59']) ?>
</p>
<p>
  <?= Html::a('2.รายงานผู้ป่วยส่งต่อ(สูงกว่าภายในจังหวัด ปีงบประมาณ2559',['report/referout59']) ?>
</p>
<p>
  <?= Html::a('3.รายงาน10อันดับโรคOPD 2559',['report/dxipd59'])?>
</p>
<p>
  <?= html::a('4.รายงาน10อันดับโรคIPD 2559',['report/dxipd59'])?>
</p>
<p>
    <?=  Html::a('5.รายงานผู้ป่วยมารับบริการแยกตามแผนก 2558',['report/rpt_dep59']) ?>
</p>
<p>
    <?=  Html::a('6.รายงานรับRefer 2559',['report/referin59']) ?>
</p>
<p>
    <?=  Html::a('7.รายงานผู้มารับบริการผู้ป่วยใน2559 (visitsครั้ง)',['report/visits_ipd59']) ?>
</p>
<p>
  <?=  Html::a('8.รายงานผู้มารับบริการผู้ป่วยนอก2559 (visitsครั้ง)',['report/visits_opd59']) ?>
</p>

<p>
  <?=  Html::a('9.รายงานผู้เสียชีวิตที่มานอนในโรงพยาบาล2559 (คน)',['report/death59']) ?>
</p>
<p>
  <?=  Html::a('10.รายงานผู้เสียชีวิต5อันดับโรค (คน)',['report/deathdx59']) ?>
</p>


<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-success">ปีงบประมาณ2558</a></div>
</div>

<p>
    <?=  Html::a('1.รายงานผู้ป่วยในDischarge',['report/dsc58']) ?>
</p>
<p>
    <?=  Html::a('2.รายงานผู้ป่วยส่งต่อ(สูงกว่าภายในจังหวัด)2558',['report/referout58']) ?>
</p>
<p>
    <?=  Html::a('3.รายงาน10อันดับโรคOPD 2558',['report/dxopd58']) ?>
</p>
<p>
    <?=  Html::a('4.รายงาน10อันดับโรคIPD 2558',['report/dxipd58']) ?>
</p>
<p>
    <?=  Html::a('5.รายงานผู้ป่วยมารับบริการแยกตามแผนก 2558',['report/rpt_dep58']) ?>
</p>
<p>
  <?=  Html::a('6.รายงานรับRefer 2558',['report/referin58']) ?>
</p>
<p>
  <?=  Html::a('7.รายงานผู้มารับบริการผู้ป่วยใน2558 (visitsครั้ง)',['report/visits_ipd58']) ?>
</p>
<p>
  <?=  Html::a('8.รายงานผู้มารับบริการผู้ป่วยนอก2558 (visitsครั้ง)',['report/visits_opd58']) ?>
</p>
<p>
  <?=  Html::a('9.รายงานผู้เสียชีวิตที่มานอนในโรงพยาบาล2558 (คน)',['report/death58']) ?>
</p>
<div class="row">

<div class = "col-sm-4"> <a href ="" class="btn btn-danger">ปีงบประมาณ2557</a></div>
</div>
<p>
    <?=  Html::a('1.รายงานผู้ป่วยในDischarge',['report/dsc57']) ?> 
</p>
<p>
    <?=  Html::a('2.รายงานผู้ป่วยส่งต่อ(สูงกว่าภายในจังหวัด)2557',['report/referout57']) ?>
</p>
<p>
    <?=  Html::a('3.รายงาน10อันดับโรคOPD 2557',['report/dxopd57']) ?>
</p>
<p>
    <?=  Html::a('4.รายงาน10อันดับโรคIPD 2557',['report/dxipd57']) ?>
</p>
<p>
    <?=  Html::a('5.รายงานผู้ป่วยมารับบริการแยกตามแผนก 2557',['report/rpt_dep57']) ?>
</p>
<p>
  <?=  Html::a('6.รายงานรับRefer 2557',['report/referin57']) ?>
</p>
<p>
  <?=  Html::a('7.รายงานผู้มารับบริการผู้ป่วยใน2557 (visitsครั้ง)',['report/visits_ipd57']) ?>
</p>
<p>
  <?=  Html::a('8.รายงานผู้มารับบริการผู้ป่วยนอก2557 (visitsครั้ง)',['report/visits_opd57']) ?>
</p>
<p>
  <?=  Html::a('9.รายงานผู้เสียชีวิตที่มานอนในโรงพยาบาล2557 (คน)',['report/death57']) ?>
</p>