<?php

namespace taskForce\user\infrastructure\filters;

use frontend\models\UserCategory;
use yii\db\ActiveQuery;

//TODO реализовать фильтры сейчас свободен, сейчас онлайн, в избранном!
class ArUserFilter
{
    /**
     * @var ActiveQuery
     */
    private $queryBuilder;

    /**
     * ArUserFilter constructor.
     * @param ActiveQuery $queryBuilder
     */
    public function __construct(ActiveQuery $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @param array $filters
     * @return ActiveQuery
     */
    public function apply(array $filters)
    {
            foreach ($filters as $paramName => $value) {
                if (method_exists($this, $paramName)) {
                    $this->$paramName($value);
                }
            }

        return $this->queryBuilder;
    }

    /**
     * @param $value
     */
    private function name($value)
    {
        $this->queryBuilder->andWhere(['like','name',$value]);
    }

    /**
     * @param $value
     */
    private function categories($value)
    {
        if($value !== "") {
            $this->queryBuilder
                ->joinWith('userCategories')
                ->andWhere([UserCategory::tableName() . '.category_id' => $value]);
        }
    }

    /**
     * @param $value
     */
    private function reviews($value)
    {
        if($value === "1") {
            $this->queryBuilder->andWhere(['has_review' => 1]);
        }
    }
}
