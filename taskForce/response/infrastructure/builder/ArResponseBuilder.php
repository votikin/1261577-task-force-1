<?php

namespace taskForce\response\infrastructure\builder;

use frontend\models\Response as modelResponse;
use taskForce\response\domain\Response;

class ArResponseBuilder
{
    public function build(modelResponse $model): Response
    {
        $response = new Response();
        $response->comment = $model->comment;
        $response->price = $model->price;
        $response->created_at = $model->created_at;
        $response->user = $model->user;

        return $response;
    }
}
