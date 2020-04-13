<?php

namespace taskForce\response\infrastructure;

use frontend\models\Response;
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
     * @return array
     */
    public function getByTaskId(int $id): array
    {
        $responses =  Response::find()->where(['task_id' => $id])->all();
        $responsesList = [];
        foreach ($responses as $response) {
            $responsesList[] = $this->builder->build($response);
        }

        return $responsesList;
    }
}
