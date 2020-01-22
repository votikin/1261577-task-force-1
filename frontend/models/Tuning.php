<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tuning".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Usertuning[] $usertunings
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
    public function getUsertunings()
    {
        return $this->hasMany(Usertuning::className(), ['tuning_id' => 'id']);
    }
}
