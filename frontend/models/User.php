<?php

namespace frontend\models;

use Yii;
use Share\StringHellper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $about
 * @property string $password
 * @property string|null $address
 * @property string $created_at
 * @property int|null $view_count
 * @property int|null $is_hidden
 * @property int|null $city_id
 * @property int $role_id
 * @property string|null $avatar
 * @property string|null $last_activity
 * @property float|null $rating
 *
 * @property Discussion[] $discussions
 * @property Discussion[] $discussions0
 * @property FavoriteExecutor[] $favoriteExecutors
 * @property FavoriteExecutor[] $favoriteExecutors0
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property City $city
 * @property Role $role
 * @property UserCategory[] $userCategories
 * @property UserSubscription[] $userSubscriptions
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['birthday', 'created_at', 'last_activity'], 'safe'],
            [['about', 'address'], 'string'],
            [['view_count', 'is_hidden', 'city_id', 'role_id'], 'integer'],
            [['rating'], 'number'],
            [['name', 'email', 'phone', 'skype', 'password', 'avatar'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
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
            'email' => 'Email',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'about' => 'About',
            'password' => 'Password',
            'address' => 'Address',
            'created_at' => 'Created At',
            'view_count' => 'View Count',
            'is_hidden' => 'Is Hidden',
            'city_id' => 'City ID',
            'role_id' => 'Role ID',
            'avatar' => 'Avatar',
            'last_activity' => 'Last Activity',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussions()
    {
        return $this->hasMany(Discussion::class, ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussions0()
    {
        return $this->hasMany(Discussion::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteExecutors()
    {
        return $this->hasMany(FavoriteExecutor::class, ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteExecutors0()
    {
        return $this->hasMany(FavoriteExecutor::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::class, ['user_id' => 'id']);
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
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('userCategories');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSubscriptions()
    {
        return $this->hasMany(UserSubscription::class, ['user_id' => 'id']);
    }
    public function getPastActivityTime()
    {
        $time = new \DateTime($this->getAttribute('last_activity'));
        $currentTime = new \DateTime();
        $interval = $time->diff($currentTime);
        if($interval->days > 0) {
            return StringHellper::declinsionNum(
                $interval->days,
                ['Был на сайте %d день назад', 'Был на сайте %d дня назад', 'Был на сайте %d дней назад']
            );
        }
        if($interval->days === 0 && $interval->h !== 0) {
            return StringHellper::declinsionNum(
                $interval->h,
                ['Был на сайте %d час назад', 'Был на сайте %d часа назад', 'Был на сайте %d часов назад']
            );
        }
        if($interval->days === 0 && $interval->h === 0) {
            return StringHellper::declinsionNum(
                $interval->i,
                ['Был на сайте %d минуту назад', 'Был на сайте %d минуты назад', 'Был на сайте %d минут назад']
            );
        }
    }
}
