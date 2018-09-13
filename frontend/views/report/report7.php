<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin57']];
$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อข้างในรายคนตามปีงบ2557';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ปวยส่งต่อข้างในรายคนตามปีงบ2557',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
