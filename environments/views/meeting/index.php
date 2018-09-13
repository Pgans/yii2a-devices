<?php
use yii\helpers\Html;

?>
<h1>หมวดรายงานการจองห้องประชุม</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-danger">รายงานการจองห้องประชุมแยกรายห้อง</a></div>
</div>
<p>
    <?=  Html::a('รายงานการจองห้องประชุมแยกรายห้อง',['meeting/countmeeting']) ?> 
</p>
<p>
    <?=  Html::a('รายงานที่จำหน่ายอุปกรณ์ที่ชำรุด',['computer/saledevices']) ?>