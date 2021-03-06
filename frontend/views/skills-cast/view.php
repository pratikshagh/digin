<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsCast */

$this->title = $model->castid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Casts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-cast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->castid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->castid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'castid',
            'userid',
            'cast',
            'crtdt',
            'crtby',
            'upddt',
            'updby',
        ],
    ]) ?>

</div>
