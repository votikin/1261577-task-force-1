<?php

namespace frontend\components\widgets;

use yii\base\Widget;

class StarsWidget extends Widget
{
    public $rating;
    public function run()
    {
        return $this->render('star-widget',[
            'rating' => $this->rating,
        ]);
    }
}
