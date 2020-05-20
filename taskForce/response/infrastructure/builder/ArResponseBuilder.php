<?php

namespace taskForce\response\infrastructure\builder;

use frontend\models\Response as modelResponse;
use taskForce\response\domain\Response;

class ArResponseBuilder
{
    /**
     * @param modelResponse $model
     * @return Response
     */
    public function build(modelResponse $model): Response
    {
        $response = new Response();
        $response->id = $model->id;
        $response->comment = $model->comment;
        $response->price = $model->price;
        $response->dateCreate = $model->created_at;
        $response->user = $model->user;
        $response->is_deleted = $model->is_deleted;
        $response->taskId = $model->task_id;

        return $response;
    }
}
