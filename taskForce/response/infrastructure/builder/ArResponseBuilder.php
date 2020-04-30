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
        $response->comment = $model->comment;
        $response->price = $model->price;
        $response->dateCreate = $model->created_at;
        $response->user = $model->user;

        return $response;
    }
}
