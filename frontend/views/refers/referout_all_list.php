<?php
use kartik\grid\GridView;

$this->title = "REF-All_LIST";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referout59']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อสูงกว่า';
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before'=>'รายงานRefersส่งต่อแยกตามแผนกบริการ(OPD-ER)',
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
            'attribute' => 'UNIT_NAME',
          ],
          [
            'attribute' => 'ICD10_TM',
          ],
          [
            'attribute' => 'ICD_NAME',
          ],
          [
            'attribute' => 'DXT_ID',
          ],
        ]
      ]
          )

          ?>
              <div class="alert alert-danger">
                  <?=$sql?>
              </div>
