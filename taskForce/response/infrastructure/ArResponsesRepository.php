<?php

namespace taskForce\response\infrastructure;

use frontend\models\Response as modelResponse;
use taskForce\response\domain\Response;
use taskForce\response\domain\ResponsesList;
use taskForce\response\domain\ResponsesRepository;
use taskForce\response\infrastructure\builder\ArResponseBuilder;
use taskForce\response\domain\ResponseNotFoundException;

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
        $responses =  modelResponse::find()->where(['task_id' => $id])->all();
        $responsesList = new ResponsesList();
        foreach ($responses as $response) {
            $responsesList[] = $this->builder->build($response);
        }

        return $responsesList;
    }


    public function getUserResponseToTask(int $user_id, int $task_id): ResponsesList
    {
        $response = modelResponse::findOne(['user_id' => $user_id, 'task_id' => $task_id,'is_deleted' => '0']);
        $responsesList = new ResponsesList();
        if($response === null) {
            return $responsesList;
        }
        $responsesList[] = $this->builder->build($response);

        return $responsesList;
    }

}
