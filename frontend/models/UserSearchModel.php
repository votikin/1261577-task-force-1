<?php

namespace frontend\models;

class UserSearchModel extends \yii\db\ActiveRecord
{
    public $categories;
    public $reviews;
    public $name;

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['categories', 'reviews','name'], 'safe'],
        ];
    }
}
