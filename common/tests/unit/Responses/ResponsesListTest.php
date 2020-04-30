<?php

namespace common\tests\Responses;

use Codeception\Test\Unit;
use common\fixtures\ResponseFixture;
use taskForce\response\domain\ResponsesRepository;

class ResponsesListTest extends Unit
{
    /**
     * @var ResponsesRepository
     */
    private $responses;

    /**
     * ResponsesListTest constructor.
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function __construct()
    {
        $this->responses = \Yii::$container->get(ResponsesRepository::class);
        parent::__construct();
    }

    public function _fixtures()
    {
        return [
            'response' => [
                'class' => ResponseFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/response.php'
            ],
        ];
    }

    public function testGetResponsesByTaskId()
    {
        $responses = $this->responses->getByTaskId(6);
        $this->assertCount(3,$responses);
    }
}
