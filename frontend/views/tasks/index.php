<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Tasks';
?>
<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>
        <?php foreach ($tasksData as $item): ?>
        <?php $taskUrl = Url::home(true)."tasks/view/".$item['id'] ?>
            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="<?=$taskUrl; ?>" class="link-regular"><h2><?= $item['short']; ?></h2></a>
                    <a  class="new-task__type link-regular" href="#"><p><?= $item['category']->name; ?></p></a>
                </div>
                <div class="new-task__icon new-task__icon--<?= $item['category']->icon; ?>"></div>
                <p class="new-task_description"><?= $item['description']; ?></p>
                <b class="new-task__price new-task__price--<?= $item['category']->icon; ?>"><?= $item['budget']; ?><b> ₽</b></b>
                <p class="new-task__place"><?= $item['address']; ?></p>
                <span class="new-task__time"><?= $item['pastTime']; ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="new-task__pagination">
        <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
                <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
        </ul>
    </div>
</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'right_block_user_form',
            'class' => 'search-task__form',
        ]); ?>
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <?= $form->field($taskSearchModel,'categories')
                    ->checkboxList($categories,['class'=>'checkbox__input',
                    ])->label(false); ?>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
                <?= $form->field($taskSearchModel,'responses')
                ->checkbox(['label' => 'Без откликов',
                    'class' => 'checkbox__input'
                ]) ?>
            </fieldset>
            <?= $form->field($taskSearchModel, 'period')->dropDownList([
                    '0' => 'За всё время',
                    '1' => 'За год',
                    '2' => 'За месяц',
                    '3' => 'За день',
                ])->label('Период'); ?>
        <?= $form->field($taskSearchModel,'name')
            ->textInput(['class' => 'input-middle input'])
            ->label('Поиск по названию',['class' => 'search-task__name']); ?>
            <button class="button" type="submit">Искать</button>
        <?php ActiveForm::end(); ?>
    </div>
</section>
