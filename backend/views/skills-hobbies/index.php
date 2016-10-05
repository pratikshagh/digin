<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SkillsHobbiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hobbies';
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/approve.js"></script>


<div class="skills-hobbies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Hobbies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'hbid',
            'hobby',
            //'crtdt',
            //'crtby',
            //'upddt',
            // 'updby',
            
              [
                    'label'=>'Approved',
                   'attribute'=>'Is_approved',
                    'format'=>'raw',
                    //'contentOptions' =>function ($model, $key, $index, $column){
                      //  $category=new backend\models\Category();
                        //$status=$model->getCategoryStatus($model->id); 
                        //return [(($status==1)? Html::encode('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>') : Html::encode('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>'))];
                   // },                    
                       'value'=>function($model){
                        $activs=$model->getIsAprvdskillhobbie($model->hbid);
                        //return $activs;
                        return $activs==1? "<span class='glyphicon glyphicon-ok-circle aprovhobbi'  aria-hidden='true'  style='color:#33CCFF' id='ven_".$model->hbid."_1'></span>" : "<span class='glyphicon glyphicon-ban-circle aprovhobbi' aria-hidden='true' style='color:#d9534f' id='ven_".$model->hbid."_0'></span>";
                        
                    },
        ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
