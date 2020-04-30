<?php

namespace taskForce\response\infrastructure;

use frontend\models\Response;
use taskForce\response\domain\ResponsesList;
use taskForce\response\domain\ResponsesRepository;
use taskForce\response\infrastructure\builder\ArResponseBuilder;

class ArResponsesRepository implements ResponsesRepository
{
    /**
     * @var ArResponseBuilder
     */
    private $builder;

    /**
     * ArResponsesRepository constructor.
     * @param ArResponseBuilder $builder
     */
    public function __construct(ArResponseBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param int $id
     * @return ResponsesList
     */
    public function getByTaskId(int $id): ResponsesList
    {
        $responses =  Response::find()->where(['task_id' => $id])->all();
        $responsesList = new ResponsesList();
        foreach ($responses as $response) {
            $responsesList[] = $this->builder->build($response);
        }

        return $responsesList;
    }
}
