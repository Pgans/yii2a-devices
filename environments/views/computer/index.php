<?php
use yii\helpers\Html;

?>
<h1>หมวดรายงานอุปกรณ์คอมพิวเตอร์</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-danger">อุปกรณ์คอมพิวเตอร์รวมทุกปีงบประมาณ</a></div>
</div>
<p>
    <?=  Html::a('รายงานจำนวนอุปกรณ์ในระบบ',['computer/countdevices']) ?> 
</p>
<p>
    <?=  Html::a('รายงานที่จำหน่ายอุปกรณ์ที่ชำรุด',['computer/saledevices']) ?>
</p>
<p>
    <?=  Html::a('รายงานการส่งซ่อมภายนอก',['computer/serviceout']) ?>
</p>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-danger">ปีงบประมาณ2557</a></div>
</div>
<p>
    <?=  Html::a('รายงานการซื้ออุกรณ์ปีงบประมาณ2557',['computer/device57']) ?> 
</p>
<p>
    <?=  Html::a('xxxxxxxxxxxxxxxxx',['computer/countdevices']) ?> 
</p>

<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-success">ปีงบประมาณ2558</a></div>
</div>
<p>
    <?=  Html::a('รายงานการซื้ออุกรณ์ปีงบประมาณ2558',['computer/device58']) ?> 
</p>
<p>
    <?=  Html::a('xxxxxxxxxxxxxxxxx',['computer/countdevices']) ?> 
</p>

<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">ปีงบประมาณ2559</a></div>
</div>
<p>
    <?=  Html::a('รายงานการซื้ออุกรณ์ปีงบประมาณ2559',['computer/device59']) ?> 
</p>
<p>
    <?=  Html::a('xxxxxxxxxxxxxxxxx',['computer/countdevices']) ?> 
</p>