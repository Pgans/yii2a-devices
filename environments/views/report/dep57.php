<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยแยกตามแผนก57';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ป่วยมารับบริการแยกตามแผนก57',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
