<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report-mbase/index']];
$this->params['breadcrumbs'][] = 'รายงานโปรแกรมMbase';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ป่วยมารับบริการแยกตามแผนก57',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )
        
        ?>
