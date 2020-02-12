<?php

namespace frontend\models;

use Yii;
use Share\StringHellper;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $short
 * @property string $description
 * @property string|null $address
 * @property int $budget
 * @property string $deadline
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $category_id
 * @property int $user_id
 * @property int|null $executor_id
 * @property int|null $city_id
 * @property int $status_id
 *
 * @property Discussion[] $discussions
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Category $category
 * @property City $city
 * @property User $executor
 * @property TaskStatus $status
 * @property User $user
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
            [['short', 'description', 'budget', 'deadline', 'category_id', 'user_id', 'status_id'], 'required'],
            [['short', 'description', 'address'], 'string'],
            [['budget', 'category_id', 'user_id', 'executor_id', 'city_id', 'status_id'], 'integer'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'executor_id' => 'Executor ID',
            'city_id' => 'City ID',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussions()
    {
        return $this->hasMany(Discussion::class, ['task_id' => 'id']);
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
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['task_id' => 'id']);
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
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
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
    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskImages()
    {
        return $this->hasMany(TaskImage::class, ['task_id' => 'id']);
    }

    public function getPastTime()
    {
        $time = new \DateTime($this->getAttribute('created_at'));
        $currentTime = new \DateTime();
        $interval = $time->diff($currentTime);
        if($interval->days > 0) {
            return StringHellper::declinsionNum(
                $interval->days,
                ['%d день назад', '%d дня назад', '%d дней назад']
            );
        }
        if($interval->days === 0 && $interval->h !== 0) {
            return StringHellper::declinsionNum(
                $interval->h,
                ['%d час назад', '%d часа назад', '%d часов назад']
            );
        }
        if($interval->days === 0 && $interval->h === 0) {
            return StringHellper::declinsionNum(
                $interval->i,
                ['%d минуту назад', '%d минуты назад', '%d минут назад']
            );
        }
    }
}
