<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsPhilosophySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-philosophy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'phid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'philosophytext') ?>

    <?= $form->field($model, 'crtdt') ?>

    <?= $form->field($model, 'crtby') ?>

    <?php // echo $form->field($model, 'upddt') ?>

    <?php // echo $form->field($model, 'updby') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
