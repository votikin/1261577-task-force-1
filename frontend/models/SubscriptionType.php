<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subscription_type".
 *
 * @property int $id
 * @property string|null $type
 *
 * @property UserSubscription[] $userSubscriptions
 */
class SubscriptionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSubscriptions()
    {
        return $this->hasMany(UserSubscription::class, ['subscription_id' => 'id']);
    }
}
