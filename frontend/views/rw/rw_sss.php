<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use common\models\RContributionIpd;
use yii\data\ActiveDataProvider;



$this->title = 'rw_sss';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['thaimed/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยในสิทธิ์ประกันสังคมAdjRWและคำนวนวันนอน';
?>
<br>
        <b><a>รายงานผู้ป่วยในสิทธิ์ประกันสังคมAdjRWและคำนวนวันนอน</a></b>
<div class='well'>
    <?php $form = ActiveForm::begin(); ?>
     ระหว่างวันที่:
           <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        ถึง:
           <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'> ตกลง </button>
        <?php $form = ActiveForm::begin([ ]);
     echo Html::a('แสดงแยกรายครั้ง', ['rw/rw_sss_list'], ['class' => 'btn btn-success', 'style' => 'margin-left:5px','target'=>'_blank']);
    // echo Html::a('เปรียบเทียบ', ['thaimed/surgeon_inout'], ['class' => 'btn btn-info', 'style' => 'margin-left:5px','target'=>'_blank']);
  
    ActiveForm::end();?>
    <?php ActiveForm::end(); ?>
</div>
<div>
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        
        'panel' => [
            'before'=>'<b style="color:blue">รายงานผู้ป่วยในสิทธิ์ประกันสังคมAdjRWและคำนวนวันนอน</b>',
            'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
          ],
               'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'สิทธิ์ประกันสังคม',
                        'header' => 'สิทธิ์ประกันสังคม',
                    ],
                    [
                        'attribute' => 'visits',
                        'header' => 'จำนวนครั้ง',
                    ],
                    [
                        'attribute' => 'sleep',
                        'header' => 'จำนวนวันนอน',
                    ],
                    
                    ]
                 ]
                  );
                    
                    ?>
                </div>
                    
                   <!-- / <div class="alert alert-info"><?=$sql?> </div> -->
