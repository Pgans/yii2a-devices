<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referout59']];
$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อรายคนตามปีงบ2559';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ปวยส่งต่อรายคน ปีงบ2559',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
