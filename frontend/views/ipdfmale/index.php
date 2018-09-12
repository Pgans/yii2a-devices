<?php
use yii\helpers\Html;

?>
<h1>หมวดรายงานผู้ป่วยในหญิง(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้</a></div></div>
<p>
    <?=  Html::a('1.รายงานผู้ป่วยในหญิงDischarge',['report/dsc59']) ?>
</p>
<p>
    <?=  Html::a('2.รายงานผู้มารับบริการผู้ป่วยใน (ipd_reg)',['report/visits_ipd']) ?>
</p>
<p>
    <?=  Html::a('3.รายงานDischargeผู้ป่วยในแยกตามสูติกรรม นารีเวช เด็ก(ผู้ป่วยในหญิง)',['ipdfmale/dxg']) ?>
</p>

