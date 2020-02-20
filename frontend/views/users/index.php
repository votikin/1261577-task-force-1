<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Users';
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
        <div class="content-view__feedback-card user__search-wrapper">
            <div class="feedback-card__top">
                <div class="user__search-icon">
                    <a href="#"><img src="<?= $item['avatar']; ?>" width="65" height="65"></a>
                    <span><?= $item['countTask']; ?></span>
                    <span><?= $item['countReview']; ?></span>
                </div>
                <div class="feedback-card__top--name user__search-card">
                    <p class="link-name"><a href="#" class="link-regular"><?= $item['name']; ?></a></p>
                    <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                    <b><?= $item['rating']; ?></b>
                    <p class="user__search-content"><?= $item['about']; ?></p>
                </div>
                <span class="new-task__time"><?= $item['past_time']; ?></span>
            </div>
            <div class="link-specialization user__search-link--bottom">
                <?php foreach ($item['categories'] as $category): ?>
                    <a href="#" class="link-regular"><?= $category; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'right_block_task_form',
            'options' => ['class' => 'search-task__form']
        ]); ?>
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <?= $form->field($userSearchModel,'categories')
                    ->checkboxList($categories,['class'=>'checkbox__input',
                        ])->label(false);?>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
<!--                <input class="visually-hidden checkbox__input" id="106" type="checkbox" name="" value="" disabled>-->
<!--                <label for="106">Сейчас свободен</label>-->
<!--                <input class="visually-hidden checkbox__input" id="107" type="checkbox" name="" value="" checked>-->
<!--                <label for="107">Сейчас онлайн</label>-->
                <?= $form->field($userSearchModel,'reviews')
                    ->checkbox(['label' => 'Есть отзывы',
                        'class' => 'checkbox__input'
                        ]); ?>
<!--                <input class="visually-hidden checkbox__input" id="109" type="checkbox" name="" value="" checked>-->
<!--                <label for="109">В избранном</label>-->
            </fieldset>
                <?= $form->field($userSearchModel,'name')
                ->textInput(['class' => 'input-middle input'])
                ->label('Поиск по имени',['class' => 'search-task__name']); ?>
            <button class="button" type="submit">Искать</button>
        <?php ActiveForm::end() ?>
    </div>
</section>
