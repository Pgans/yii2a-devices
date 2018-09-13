<?php
use yii\helpers\Html;

?>
<h1>หมวดรายงานผู้เสียชีวิตในโรงพยาบาล</h1>

<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้</a></div></div>
<p>
    <?=  Html::a('1.รายงานผู้เสียชีวิตในโรงพยาบาลทั้งหมด',['deaths/death_all']) ?>
</p>
<p>
    <?=  Html::a('2.รายงานผู้ป่วยในเสียชีวิตและระบุชื่อโรค',['deaths/deathipd']) ?>
</p>
 <p>
    <?=  Html::a('3.รายงานผู้เสียชีวิต5อันดับโรค',['deaths/deathdx59']) ?>
</p>






