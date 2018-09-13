<?php
use kartik\grid\GridView;

$this->title = "REF-DX_LIST";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referout59']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อสูงกว่า';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(Diagnosis)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    
        'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'VISIT_ID',
                    ],
                    [
                        'attribute' => 'HN',
                    ],
                    [
                        'attribute' => 'HOSP_NAME',
                    ],
                    [
                        'attribute' => 'REG_DATETIME',
                    ],
                    [
                        'attribute' => 'RF_DT',
                    ],
                    [
                        'attribute' => 'STAFF_ID'
                    ],
                    [
                        'attribute' => 'ICD10_TM'
                    ],
                    [
                        'attribute' => 'UNIT_NAME'
                    ],


        ]
    ]
        )

        ?>
        <div class ="alert alert-danger" ><?=$sql?></div>
