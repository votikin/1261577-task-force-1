<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $messenger
 * @property string|null $about
 * @property string $password
 * @property string|null $address
 * @property string $created_at
 * @property int|null $city_id
 * @property int $role_id
 *
 * @property Correspondence[] $correspondences
 * @property Correspondence[] $correspondences0
 * @property Eventsfeed[] $eventsfeeds
 * @property Favorites[] $favorites
 * @property Favorites[] $favorites0
 * @property Response[] $responses
 * @property Rewiew[] $rewiews
 * @property Subscription[] $subscriptions
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property City $city
 * @property Role $role
 * @property Usercategory[] $usercategories
 * @property Userimages[] $userimages
 * @property Usertuning[] $usertunings
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
            [['birthday', 'created_at'], 'safe'],
            [['about', 'address'], 'string'],
            [['city_id', 'role_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['skype', 'messenger'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 150],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
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
            'messenger' => 'Messenger',
            'about' => 'About',
            'password' => 'Password',
            'address' => 'Address',
            'created_at' => 'Created At',
            'city_id' => 'City ID',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorrespondences()
    {
        return $this->hasMany(Correspondence::className(), ['recipient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorrespondences0()
    {
        return $this->hasMany(Correspondence::className(), ['sender_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventsfeeds()
    {
        return $this->hasMany(Eventsfeed::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['choosing_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites0()
    {
        return $this->hasMany(Favorites::className(), ['selected_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRewiews()
    {
        return $this->hasMany(Rewiew::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsercategories()
    {
        return $this->hasMany(Usercategory::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserimages()
    {
        return $this->hasMany(Userimages::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsertunings()
    {
        return $this->hasMany(Usertuning::className(), ['user_id' => 'id']);
    }
}
