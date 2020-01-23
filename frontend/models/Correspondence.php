<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "correspondence".
 *
 * @property int $id
 * @property string $text
 * @property string $created_at
 * @property int $sender_id
 * @property int $recipient_id
 * @property int $task_id
 *
 * @property User $recipient
 * @property User $sender
 * @property Task $task
 */
class Correspondence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correspondence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'sender_id', 'recipient_id', 'task_id'], 'required'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
            [['sender_id', 'recipient_id', 'task_id'], 'integer'],
            [['recipient_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['recipient_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sender_id' => 'id']],
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
            'text' => 'Text',
            'created_at' => 'Created At',
            'sender_id' => 'Sender ID',
            'recipient_id' => 'Recipient ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(User::class, ['id' => 'recipient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::class, ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }
}
