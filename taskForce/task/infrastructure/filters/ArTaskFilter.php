<?php

namespace taskForce\task\infrastructure\filters;

use frontend\models\Response;
use frontend\models\Task;
use yii\db\ActiveQuery;

class ArTaskFilter
{
    /**
     * @var ActiveQuery
     */
    private $queryBuilder;

    /**
     * ArTaskFilter constructor.
     * @param ActiveQuery $queryBuilder
     */
    public function __construct(ActiveQuery $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function apply(array $filters)
    {
        foreach ($filters as $paramName => $value) {
            if (method_exists($this, $paramName)) {
                $this->$paramName($value);
            }
        }

        return $this->queryBuilder;
    }

    private function categories($value)
    {
        if($value !== "") {
            $this->queryBuilder->andWhere(["category_id" => $value]);
        }
    }

    private function responses($value)
    {
        if($value === "1") {
            $this->queryBuilder->joinWith('responses')->andWhere([Response::tableName().'.id' => null]);
        }
    }

    private function name($value)
    {
        $this->queryBuilder->andWhere(['or',
            ['like',Task::tableName().'.description', $value],
            ['like',Task::tableName().'.short', $value],
        ]);
    }

    private function period($value)
    {
        if($value !== "0") {
            $currentTime = new \DateTime();
            $needTime = new \DateTime();
            switch ($value) {
                case "1":
                    $needTime->modify('-1 year');
                    break;
                case "2":
                    $needTime->modify('-1 month');
                    break;
                case "3":
                    $needTime->modify('-1 day');
                    break;
            }
            $this->queryBuilder->andWhere(['between', Task::tableName() . '.created_at',
                $needTime->format('c'), $currentTime->format('c')
            ]);
        }
    }
}
