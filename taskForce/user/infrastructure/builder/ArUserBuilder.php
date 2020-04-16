<?php

namespace taskForce\user\infrastructure\builder;

use frontend\models\User as modelUser;
use taskForce\category\domain\CategoriesRepository;
use taskForce\category\infrastructure\builder\ArCategoryBuilder;
use taskForce\user\domain\Contact;
use taskForce\user\domain\Detail;
use taskForce\user\domain\User;

class ArUserBuilder
{
    /**
     * @var CategoriesRepository
     */
    private $category;
    public function build(modelUser $model, $detailView = false): User
    {
        $user = new User();
        $categoryBuilder = new ArCategoryBuilder();
        $categoriesList = [];
        foreach ($model->categories as $category) {
            $categoriesList[] = $categoryBuilder->build($category);
        }
        $user->category = $categoriesList;
        $user->id = $model->id;
        $user->avatar = $model->avatar;
        $user->name = $model->name;
        $user->created_at = $model->created_at;
        $user->last_activity = $model->last_activity;
        $user->rating = $model->rating;
        $detail = new Detail($model->about,$model->address,$model->birthday);
        $user->detail = $detail;
        $user->cityId = $model->city_id;
        if($detailView === true) {
            $contacts = new Contact($model->phone, $model->skype, $model->email);
            $user->contacts = $contacts;
        }

        return $user;
    }
}
