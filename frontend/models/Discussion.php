<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "discussion".
 *
 * @property int $id
 * @property string $message
 * @property string $created_at
 * @property int $user_id
 * @property int $executor_id
 * @property int $task_id
 *
 * @property User $executor
 * @property Task $task
 * @property User $user
 */
class Discussion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discussion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'user_id', 'executor_id', 'task_id'], 'required'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['user_id', 'executor_id', 'task_id'], 'integer'],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
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
            'message' => 'Message',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'executor_id' => 'Executor ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::class, ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
