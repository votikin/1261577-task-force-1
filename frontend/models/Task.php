<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $short
 * @property string $description
 * @property string|null $address
 * @property int $budget
 * @property string $deadline
 * @property int|null $status
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $category_id
 * @property int|null $owner_id
 * @property int|null $executor_id
 * @property int|null $city_id
 *
 * @property Correspondence[] $correspondences
 * @property Response[] $responses
 * @property Rewiew[] $rewiews
 * @property Category $category
 * @property User $owner
 * @property User $executor
 * @property City $city
 * @property TaskImage[] $taskImages
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short', 'description', 'budget', 'deadline', 'category_id'], 'required'],
            [['short', 'description', 'address'], 'string'],
            [['budget', 'status', 'category_id', 'owner_id', 'executor_id', 'city_id'], 'integer'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['owner_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short' => 'Short',
            'description' => 'Description',
            'address' => 'Address',
            'budget' => 'Budget',
            'deadline' => 'Deadline',
            'status' => 'Status',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'owner_id' => 'Owner ID',
            'executor_id' => 'Executor ID',
            'city_id' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorrespondences()
    {
        return $this->hasMany(Correspondence::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRewiews()
    {
        return $this->hasMany(Rewiew::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::class, ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::class, ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskImages()
    {
        return $this->hasMany(TaskImage::class, ['task_id' => 'id']);
    }
}
