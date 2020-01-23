<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tuning".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property UserTuning[] $userTunings
 */
class Tuning extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tuning';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTunings()
    {
        return $this->hasMany(UserTuning::class, ['tuning_id' => 'id']);
    }
}
