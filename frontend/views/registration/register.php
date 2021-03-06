<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false
                ]); ?>
                              
                <?php /*************new****************/ 
                if(!Yii::$app->user->isGuest) {
                      $auth = Yii::$app->authManager; 
                      $roles=$auth->getRoles();
                      foreach ($roles as $rolenm=>$role) {
                          if($role->name=='Admin' || $role->name=='Executive')
                        $userRole[$rolenm] = $role->name;
                      }
                      //var_dump($userRole);
                     // $data= yii\helpers\ArrayHelper::map($roles, 'name', 'name');                       
                      echo $form->field($model, 'role')->dropDownList($userRole); 
                } ?>
                
               
                <?= $form->field($model, 'phone')   /* new */  ?> 
                
                <?= $form->field($model, 'email') ?>
                
                <?= $form->field($model, 'username') ?>                    

                <?php //if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                <?php// endif ?>                 
                
                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <!--?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?-->
        </p>
    </div>
</div>

<script type="text/javascript">
    <?php if(Yii::$app->user->isGuest) {?>
   document.getElementById('register-form-email').addEventListener("change", function(event) {      
      var uname=document.getElementById('register-form-email').value;
      document.getElementById('register-form-username').value=uname;
});    
  <?php } ?>
</script>