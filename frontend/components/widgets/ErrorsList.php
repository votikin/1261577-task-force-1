<?php

namespace frontend\components\widgets;

use yii\base\Widget;

class ErrorsList extends Widget
{
    public $errors;
    public $labels;

    public function run()
    {
        $list = [];
        foreach ($this->errors as $error => $field) {
            foreach ($field as $item) {
                $label = $this->labels[$error];
                $list[$label] = $item;
            }
        }

        return $this->render('error-list',[
            'errors' => $list,
        ]);
    }
}
