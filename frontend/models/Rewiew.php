<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rewiew".
 *
 * @property int $id
 * @property string $description
 * @property int $estimate
 * @property string $created_at
 * @property int $user_id
 * @property int $task_id
 *
 * @property Task $task
 * @property User $user
 */
class Rewiew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rewiew';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'estimate', 'user_id', 'task_id'], 'required'],
            [['description'], 'string'],
            [['estimate', 'user_id', 'task_id'], 'integer'],
            [['created_at'], 'safe'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
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
            'description' => 'Description',
            'estimate' => 'Estimate',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
