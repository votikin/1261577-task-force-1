<?php

namespace frontend\models;

use Yii;

class TaskSearchModel extends \yii\db\ActiveRecord
{
    public $categories;
    public $responses;
    public $name;
    public $period;
    public const PERIOD_VALUES = [
        '0' => 'За всё время',
        '1' => 'За год',
        '2' => 'За месяц',
        '3' => 'За день',
    ];

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['categories', 'responses','name','period'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'responses' => 'Без откликов',
            'period' => 'Период',
            'name' => 'Поиск по названию',
        ];
    }
}
