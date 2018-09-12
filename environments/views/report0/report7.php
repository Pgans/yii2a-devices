<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานส่งซ่อมร้านภายนอก';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=> 'รายงานส่งซ่อมร้านภายนอก',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )
        
        ?>