<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "events_feed".
 *
 * @property int $id
 * @property string $description
 * @property string $created_at
 * @property string $date_create
 * @property int $user_id
 *
 * @property User $user
 */
class EventsFeed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events_feed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'created_at', 'user_id'], 'required'],
            [['description'], 'string'],
            [['created_at', 'date_create'], 'safe'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'created_at' => 'Created At',
            'date_create' => 'Date Create',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
