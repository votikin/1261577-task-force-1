<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property string $created_at
 * @property int $choosing_id
 * @property int $selected_id
 *
 * @property User $choosing
 * @property User $selected
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['choosing_id', 'selected_id'], 'required'],
            [['choosing_id', 'selected_id'], 'integer'],
            [['choosing_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['choosing_id' => 'id']],
            [['selected_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['selected_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'choosing_id' => 'Choosing ID',
            'selected_id' => 'Selected ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChoosing()
    {
        return $this->hasOne(User::className(), ['id' => 'choosing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelected()
    {
        return $this->hasOne(User::className(), ['id' => 'selected_id']);
    }
}
