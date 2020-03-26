<?php

namespace taskForce\user\infrastructure\filters;

use yii\db\ActiveQuery;

class ArFilterUsers
{
    /**
     * @var ActiveQuery
     */
    private $queryBuilder;

    /**
     * ArFilterUsers constructor.
     * @param ActiveQuery $queryBuilder
     */
    public function __construct(ActiveQuery $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function apply(array $filter)
    {
        foreach ($filter  as $paramName => $value) {
            if (method_exists($this, $paramName)) {
                $this->$paramName($value);
            }
        }

        return $this->queryBuilder;
    }

    private function name($value)
    {
        $this->queryBuilder->andWhere(['like','name', $value]);
    }

    private function city($value) {

        $this->queryBuilder->andWhere(['city_id' => $value]);
    }

    private function category($value) {

        $this->queryBuilder->andWhere(['category_id' => $value]);
    }



}
