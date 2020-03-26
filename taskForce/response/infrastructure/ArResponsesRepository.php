<?php

namespace taskForce\response\infrastructure;

use frontend\models\Response;
use taskForce\response\domain\ResponsesRepository;

class ArResponsesRepository implements ResponsesRepository
{

    public function getByTaskId(int $id)
    {
        return Response::find()->where(['task_id' => $id])->all();
    }
}
