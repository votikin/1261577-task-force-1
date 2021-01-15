<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use \yii\bootstrap\Html;

/* @var $this yii\web\View
 * @var $usersData
 * @var $userSearchModel
 * @var $categories
 */

$this->title = 'Users';
//TODO Сортировка пользователей по рейтингу, числу заказов, популярности
?>

<section class="user__search">
    <div class="user__search-link">
        <p>Сортировать по:</p>
        <ul class="user__search-list">
            <li class="user__search-item user__search-item--current">
                <a href="#" class="link-regular">Рейтингу</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Числу заказов</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Популярности</a>
            </li>
        </ul>
    </div>
    <?php foreach ($usersData as $item): ?>
        <?php $userUrl = Url::to(['users/view', 'id' => $item['user']['id']]); ?>
        <div class="content-view__feedback-card user__search-wrapper">
            <div class="feedback-card__top">
                <div class="user__search-icon">
                    <a href="<?=$userUrl; ?>"><img src="<?= $item['user']['avatar']; ?>" width="65" height="65"></a>
                    <span><?= $item['countTasks']; ?></span>
                    <span><?= $item['countReviews']; ?></span>
                </div>
                <div class="feedback-card__top--name user__search-card">
                    <p class="link-name"><a href="<?=$userUrl; ?>" class="link-regular"><?= $item['user']['name']; ?></a></p>
                    <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                    <b><?= $item['user']['rating']; ?></b>
                    <p class="user__search-content"><?= $item['user']['detail']['about']; ?></p>
                </div>
                <span class="new-task__time"><?= $item['user']['pastTime']; ?></span>
            </div>
            <div class="link-specialization user__search-link--bottom">
                <?php foreach ($item['user']['categories'] as $category): ?>
                    <?= Html::a($category['name'],['tasks/'],[
                        'class' => 'link-regular',
                        'data-method' => 'GET',
                        'data-params' => [
                            'categories' => $category['id'],
                        ]
                    ]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'right_block_task_form',
            'class' => 'search-task__form',
        ]); ?>
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <?= $form->field($userSearchModel,'categories')
                    ->checkboxList($categories,['class'=>'checkbox__input',
                        ])->label(false);?>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
                <?= $form->field($userSearchModel,'reviews')
                    ->checkbox(['label' => 'Есть отзывы',
                        'class' => 'checkbox__input'
                        ]); ?>
            </fieldset>
                <?= $form->field($userSearchModel,'name')
                ->textInput(['class' => 'input-middle input'])
                ->label('Поиск по имени',['class' => 'search-task__name']); ?>
            <button class="button" type="submit">Искать</button>
        <?php ActiveForm::end() ?>
    </div>
</section>
