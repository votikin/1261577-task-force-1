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
    public static function tableName()
    {
        return 'user_search_form';
    }

    public function attributeLabels()
    {
        return [
            'categories' => 'Categories',
            'reviews' => 'Reviews',
            'name' => 'Name',
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'reviews','name'], 'safe'],
        ];
    }
}
