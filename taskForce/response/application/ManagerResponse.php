<?php

namespace taskForce\response\application;

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

}
