<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use frontend\models\Tumbon;

$this->title = "`specailpp";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['chronic/index']];
$this->params['breadcrumbs'][] = 'รายงานพัฒนาการเด็กสมวัยอายุ 9เดือน';
?>
<b style = "color:blue">รายงานพัฒนาการเด็กสมวัยอายุ 9เดือน</b>
<div class='well'>
     <?php $form = ActiveForm::begin([
    'method' => 'POST',
    'action' => ['addictive/specailpp'],
]); ?>
        <?php
        $items = ArrayHelper::map(Tumbon::find()->all(), 'town_id', 'town_name');
        echo Html::dropDownList('townid', $townid, $items, ['prompt' => '--- เลือกตำบล ---']);
        ?>
        <button class='btn btn-success'> 8เดือน </button>
        <?php $form = ActiveForm::begin([ ]);
   echo Html::a('18เดือน', ['addictive/specailpp18'], ['class' => 'btn btn-warning','target'=>'_blank']);
   echo Html::a('30เดือน', ['addictive/specailpp30'], ['class' => 'btn btn-info','target'=>'_blank']);
   echo Html::a('42เดือน', ['addictive/specailpp42'], ['class' => 'btn btn-success','target'=>'_blank']);
   echo Html::a('60เดือน', ['addictive/specailpp60'], ['class' => 'btn btn-danger','target'=>'_blank']);
    ActiveForm::end();?>
    <?php ActiveForm::end(); ?>
</div>
        
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานพัฒนาการเด็กสมวัยอายุ 9เดือน</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-info">
            <?=$sql?>
        </div>
