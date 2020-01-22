<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usertuning".
 *
 * @property int $id
 * @property string $created_at
 * @property int $user_id
 * @property int $tuning_id
 *
 * @property Tuning $tuning
 * @property User $user
 */
class Usertuning extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usertuning';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['user_id', 'tuning_id'], 'required'],
            [['user_id', 'tuning_id'], 'integer'],
            [['tuning_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tuning::className(), 'targetAttribute' => ['tuning_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'tuning_id' => 'Tuning ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuning()
    {
        return $this->hasOne(Tuning::className(), ['id' => 'tuning_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
