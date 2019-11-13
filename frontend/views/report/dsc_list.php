<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'DSC-LIST';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยในDischarge';

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ป่วยในDischarge ตามปีงบ',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
<?php //echo $sql;?>