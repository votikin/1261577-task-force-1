<?php

namespace taskForce\response\application;

use taskForce\response\domain\Response;
use taskForce\response\domain\ResponsesList;
use taskForce\response\domain\ResponsesRepository;

class ManagerResponse
{
    /**
     * @var ResponsesRepository
     */
    private $response;

    /**
     * ManagerResponse constructor.
     * @param ResponsesRepository $response
     */
    public function __construct(ResponsesRepository $response)
    {
        $this->response = $response;
    }

    /**
     * @param int $id
     * @return ResponsesList
     */
    public function getResponsesByTaskId(int $id): ResponsesList
    {
        return $this->response->getByTaskId($id);
    }

    public function getUserResponseToTask(int $user_id, int $task_id): ResponsesList
    {
        return $this->response->getUserResponseToTask($user_id, $task_id);
    }

    public function refuseResponse(int $id): void
    {
        $this->response->refuseResponse($id);
    }

    public function addNewResponse(Response $response):void
    {
        $this->response->addNewResponse($response);
    }

    public function getResponseById(int $id): Response
    {
        return $this->response->getResponseById($id);
    }
}
