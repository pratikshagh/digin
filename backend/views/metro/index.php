<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MetroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Metros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Metro'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'mid',
            //'dpid',
           /* [
                 'label' => 'Delivery Partner',
                 'attribute' => 'dpid',               
                 'value' => function($data){
                    return $data->getPartner($data->dpid);
                 },
            ],            without working filter*/
            [
                 'label' => 'Delivery Partner',
                 'attribute' => 'deliverypartner',               
                 'value' => 'deliverypartner.name',
            ],        // with working filter
            //'cityid',
            [
                 'label' => 'City',
                 'attribute' => 'city',               
                 'value' => function($data){
                    return $data->getCity($data->dpid);
                 },
            ],
            ///'crtdt',
            //'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
