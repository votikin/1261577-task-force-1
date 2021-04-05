<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "discussion".
 *
 * @property int $id
 * @property string $message
 * @property string $created_at
 * @property int $task_id
 * @property int|null $author_id
 * @property int|null $is_executor_view
 * @property int|null $is_customer_view
 *
 * @property User $author
 * @property Task $task
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
            [['message', 'task_id'], 'required'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['task_id', 'author_id', 'is_executor_view', 'is_customer_view'], 'integer'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
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
            'task_id' => 'Task ID',
            'author_id' => 'Author ID',
            'is_executor_view' => 'Is Executor View',
            'is_customer_view' => 'Is Customer View',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }
}
