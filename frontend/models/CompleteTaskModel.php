<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use taskForce\review\domain\Review;
use taskForce\task\domain\Task;

class CompleteTaskModel extends ActiveRecord
{
    const COMPLETE_RESULT = '1';
    const FAIL_RESULT = '0';
    const RESULT_STATUS = [
        self::COMPLETE_RESULT => 'ДА',
        self::FAIL_RESULT => 'ВОЗНИКЛИ ПРОБЛЕМЫ',
    ];

    public $result;
    public $comment;
    public $estimate;

    public function attributeLabels()
    {
        return [
            'result' => 'ЗАДАНИЕ ВЫПОЛНЕНО?',
            'comment' => 'КОММЕНТАРИЙ',
            'estimate' => 'ОЦЕНКА',
        ];
    }

    public function rules()
    {
        return [
            ['result','required','message'=>'Задание выполнено?'],
            ['estimate','required'],
            ['comment','safe'],
        ];
    }

    public function makeNewReview(int $taskId) {
        $review = new Review();
        $review->description = $this->comment;
        $review->estimate = $this->estimate;
        $task = new Task();
        $task->id = $taskId;
        $review->task = $task;
        $review->isComplete = $this->result;

        return $review;
    }
}
