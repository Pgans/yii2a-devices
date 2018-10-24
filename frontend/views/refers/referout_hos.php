<?php
use kartik\grid\GridView;

$this->title = "REF-All_LIST";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referout59']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อสูงกว่า';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue">รายงานผู้ป่วยที่มีการส่งต่อ(รพ.สูงกว่า)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
        <div class ="alert alert-danger" ><?=$sql?></div>
