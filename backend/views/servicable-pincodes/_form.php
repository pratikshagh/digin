<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicablePincodes */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/pincode.js"></script>
<div class="servicable-pincodes-form">

    <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data','id'=>'servpincodeform']]); ?>

     <?php $dlpartners=  backend\models\DeliveryPartner::find()->all();
          $dpdata=  ArrayHelper::map($dlpartners, 'dpid', 'name') ?>
    <div class="row">
        <div class="col-xs-3">
            <?php echo $form->field($model, 'dpid')->dropDownList($dpdata,['prompt'=>'Select']) ?>
        </div>
    </div>
    
    <?php $states= \frontend\models\States::find()->all();
          $statedata=  ArrayHelper::map($states, 'id', 'name')?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'state')->dropDownList($statedata,['prompt'=>'Select']) ?>
        </div>
    </div>
    
    <?php $cities= \frontend\models\Cities::find()->all();
          $citydata=  ArrayHelper::map($cities, 'id', 'name')?>
     <div class="row">
        <div class="col-xs-3"> 
        <?php echo  $form->field($model, 'cityid')-> listBox(
                $citydata,               
                array('id'=>'listone','size'=>10));
          ?>
        </div>
     </div>
     <div class="row">
        <div class="col-xs-3"> 
            <?php echo $form->field($model,'pin')->textInput(); ?>
        </div>    </div>
          <div class="row">
         <div class="col-xs-2"> 
           <?php echo Html::Button(' Add ',['id'=>'btn1','class'=>'btn btndefault']); ?>
           </div>
         
              <div class="col-xs-2" style="margin-left: -119px;"> 
           <?php echo Html::Button(' Remove ',['id'=>'btn2','class'=>'btn btndefault']); ?>
           </div>
         
         </div><br>
         
     <div class="row">
         <div class="col-xs-3"> 
          <?php 
       if(!isset($pinData))
        {
             $pinData = array();
        }
          echo  $form->field($model, 'pincodenew')-> listBox(
                $pinData,               
                array('id'=>'listone1','size'=>10,'multiple'=>'true')); ?>
           </div>
       </div>
    
         <div class="row">
         <div class="col-xs-4">
         <?php echo '<div style="font-size: 25px; text-align: justify;"><b>OR</b></div>' ;
          echo '<div class="alert alert-warning"><strong>Warning....!</strong> Either insert pincodes manually in above input box OR upload an Excel file.</div>';
          ?>
      
           <?= $form->field($model,'excelfile')->fileInput() ?>
       </div>  </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success submit' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
     $(document).ready(function(){
         $('#servicablepincodes-state').change(function(){            
            var state=$('#servicablepincodes-state').val();
            //alert(state);
             $.ajax({
                type:"POST",
                   url:"index.php?r=servicable-pincodes/getcity",           
                   data:{stateid:state},
                   success:  function(result) {                                   
                       $("#listone").empty();
                      var data=jQuery.parseJSON(result);
                       $.each(data, function(index, value) {                   
                         $('#listone').append($('<option>').text(value['name']).val(value['id']));
                        
                        });

                    },
            });       
        });
     });
</script>