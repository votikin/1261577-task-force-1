<?php

namespace frontend\models;

use Yii;

class TaskSearchModel extends \yii\db\ActiveRecord
{
    public $categories;
    public $responses;
    public $name;
    public $period;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_search_model';
    }

    public function attributeLabels()
    {
        return [
            'categories' => 'Categories',
            'responses' => 'Responses',
            'name' => 'Name',
            'period' => 'Period'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'responses','name','period'], 'safe'],
        ];
    }
}
