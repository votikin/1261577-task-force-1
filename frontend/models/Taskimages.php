<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taskimages".
 *
 * @property int $id
 * @property string $name
 * @property string $image_path
 * @property string $created_at
 * @property int $task_id
 *
 * @property Task $task
 */
class Taskimages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taskimages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image_path', 'task_id'], 'required'],
            [['created_at'], 'safe'],
            [['task_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['image_path'], 'string', 'max' => 150],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image_path' => 'Image Path',
            'created_at' => 'Created At',
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
}
