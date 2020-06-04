<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class CompleteTaskModel extends ActiveRecord
{
    const RESULT_STATUS = [
        '0' => 'ДА',
        '1' => 'ВОЗНИКЛИ ПРОБЛЕМЫ',
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
            ['result','radioIsCheck'],
            ['estimate','required'],
        ];
    }

    public function radioIsCheck($attribute,$params){
        if(!$this->hasErrors()){
            if(empty($this->result)){
                $this->addError('result', "Выполнено ли задание?");
            }

        }
    }
}
