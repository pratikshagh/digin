<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorCurrencySettingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-currency-setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vid') ?>

    <?= $form->field($model, 'base_currency') ?>

    <?= $form->field($model, 'country') ?>

    <?= $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'currency_rate') ?>

    <?php // echo $form->field($model, 'percentaddition') ?>

    <?php // echo $form->field($model, 'crtdt') ?>

    <?php // echo $form->field($model, 'crtby') ?>

    <?php // echo $form->field($model, 'upddt') ?>

    <?php // echo $form->field($model, 'updby') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
