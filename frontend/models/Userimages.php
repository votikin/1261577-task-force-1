<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userimages".
 *
 * @property int $id
 * @property string $image_path
 * @property string $created_at
 * @property int $user_id
 *
 * @property User $user
 */
class Userimages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userimages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_path', 'user_id'], 'required'],
            [['created_at'], 'safe'],
            [['user_id'], 'integer'],
            [['image_path'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_path' => 'Image Path',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
