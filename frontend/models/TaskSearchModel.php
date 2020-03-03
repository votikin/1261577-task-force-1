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

    public function rules()
    {
        return [
            [['categories', 'responses','name','period'], 'safe'],
        ];
    }
}
