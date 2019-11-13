<?php
use kartik\grid\GridView;

$this->title = "REF-LIST";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referout59']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อสูงกว่า';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ปวยส่งต่อสูงกว่า',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
        <div class ="alert alert-danger" ><?=$sql?></div>
