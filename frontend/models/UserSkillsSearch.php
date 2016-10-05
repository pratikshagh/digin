<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\UserSkills;

/**
 * UserSkillsSearch represents the model behind the search form about `app\models\UserSkills`.
 */
class UserSkillsSearch extends UserSkills
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usid', 'userid', 'skillid', 'crtby', 'updby'], 'integer'],
            [['description', 'crtdt', 'upddt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserSkills::find()->where(['crtby'=>Yii::$app->user->identity->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usid' => $this->usid,
            'userid' => $this->userid,
            'skillid' => $this->skillid,
            'crtdt' => $this->crtdt,
            'crtby' => $this->crtby,
            'upddt' => $this->upddt,
            'updby' => $this->updby,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
