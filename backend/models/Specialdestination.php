<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "specialdestination".
 *
 * @property integer $id
 * @property integer $dpid
 * @property integer $cityid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Specialdestination extends \yii\db\ActiveRecord
{
     public $state=null;
     public $cityarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialdestination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dpid', 'cityid'], 'required'],
            [['dpid', 'cityid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           'id' => 'ID',
            'dpid' => 'Delivery Partener',
            'cityid' => 'City',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
      
    public function getDeliverypartner()
    {
        return $this->hasOne(DeliveryPartner::className(), ['dpid' => 'dpid']);
    }
    
    public function getCities()
    {
        return $this->hasMany(\frontend\models\Cities::className(), ['id'=>'cityid']);
    }
    public function getPartner($id)
    {
        $dp=  DeliveryPartner::find()->where(['dpid'=>$id])->one();
        return $dp['name'];
    }    
    public function getCity($id)
    {
        $dp= Specialdestination::find()->where(['dpid'=>$id])->all(); 
        $cities=array();
        $citylist='';
        foreach ($dp as $d){
        $city=  \frontend\models\Cities::find()->where(['id'=>$d['cityid']])->one();
        array_Push($cities, $city['name']);
        }
        $citylist=  implode(',', $cities);
        return $citylist;
    }  
    
    
    public function isinSpecialdest($pin1,$pin2)
    {
        //return "pin1...".$pin1."pin2....".$pin2;
        $venpin=  Pincode::find()->where(['pincode'=>$pin1])->one();       
        $buyerpin=  Pincode::find()->where(['pincode'=>$pin2])->one();
        $spd1= Specialdestination::find()->where(['cityid'=>$venpin['cityid']])->one();
        $spd2= Specialdestination::find()->where(['cityid'=>$buyerpin['cityid']])->one();
        $spd1=''; $spd2='';             //..to check
        //if($spd1!="" || $spd2!="")    //...old
        if($spd1!="")
        {
            return 'Special Destination';
        }
        else{
            return false;
        }  
        //return $venpin['cityid']."...Zone".$buyerpin['cityid'];
    }
    public function isinSpecialdestbycity($city,$pin2)
    {
         //return "<br>City...".$city."pin....".$pin2;        
         //$vencity=  \frontend\models\Cities::find()->where(['name'=>$city])->one();
         $cityname="%".$city."%"; 
         $vencity=  \frontend\models\Cities::find()->where('name LIKE :query')
                                                   ->addParams([':query'=>$cityname])->one();       
         $buyerpin=  Pincode::find()->where(['pincode'=>$pin2])->one();
         $spd1= Specialdestination::find()->where(['cityid'=>$vencity['id']])->one();
         $spd2= Specialdestination::find()->where(['cityid'=>$buyerpin['cityid']])->one();
         //$spd1=''; $spd2='';         //..to check
         //if($spd1!="" || $spd2!="")  //..old
         if($spd1!="")
        {
            return 'Special Destination';
        }
        else{
            return false;
        }      
    }
}
