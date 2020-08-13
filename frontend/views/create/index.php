<?php

use yii\bootstrap\ActiveForm;
use frontend\models\TaskCreateModel;
use yii\helpers\ArrayHelper;
use frontend\components\widgets\ErrorsList;

/** @var $this yii\web\View
 * @var $taskCreateModel TaskCreateModel
 */

$this->title = "Новое задание";
$categoriesList = ArrayHelper::map($categories,'id', 'name');
?>

<section class="create__task">
    <h1>Публикация нового задания</h1>
    <div class="create__task-main">
        <?php $form = ActiveForm::begin([
            'id' => 'task-form',
            'method' => 'POST',
            'action' => 'create',
            'enableClientValidation' => false,
            'options' => ['class' => 'create__task-form form-create','enctype' => 'multipart/form-data'],
            'fieldConfig' => ['options' => ['tag' => false],'template' => "{label}\n{input}\n{error}"],
            'errorCssClass' => 'text-danger',
        ]); ?>
        <?= $form->field($taskCreateModel,'short')
            ->input('text', array(
                'class' => 'input textarea',
                'placeholder' => 'Повесить полку',
                'rows' => '1',
            )); ?>
        <span>Кратко опишите суть работы</span>
        <?= $form->field($taskCreateModel,'description')
            ->textarea(array(
                'class' => 'input textarea',
                'placeholder' => 'Подробное описание',
                'rows' => '7',
            )); ?>
        <span>Укажите все пожелания и детали, чтобы исполнителям было проще соориентироваться</span>
        <?= $form->field($taskCreateModel,'category_id')
            ->dropDownList($categoriesList,array(
                'class' => 'multiple-select input multiple-select-big',
                'size' => '1'));
        ?>
        <span>Выберите категорию</span>
            <?= $form->field($taskCreateModel,'files[]',
                ['template' =>
                    "{label}<span>Загрузите файлы, которые помогут исполнителю лучше выполнить или оценить работу</span><div class='create__file dz-clickable'>{input}</div>"])
            ->input('file',array(
                    'multiple' => 'true',
                ));
            ?>
        <?= $form->field($taskCreateModel,'location')
            ->input('search',array(
                'class' => 'input-navigation input-middle input',
                'placeholder' => 'Санкт-Петербург, Калининский район',
            )); ?>
        <span>Укажите адрес исполнения, если задание требует присутствия</span>
        <div class="create__price-time">
            <?= $form->field($taskCreateModel,'budget',
                ['template' => "<div class=\"create__price-time--wrapper\">{label}\n{input}\n{error}\n<span>Не заполняйте для оценки исполнителем</span></div>"])
                ->textarea([
                    'class' => 'input textarea input-money',
                    'rows' => '1',
                    'placeholder' => '1000',
                ]); ?>
            <?= $form->field($taskCreateModel,'deadline',
                ['template' => "<div class=\"create__price-time--wrapper\">{label}\n{input}\n{error}\n<span>Укажите крайний срок исполнения</span></div>"])
                ->input('date',[
                    'class' => 'input-middle input input-date',
                    'rows' => '1',
                    'placeholder' => '10.11, 15:00',
                ]); ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="create__warnings">
            <div class="warning-item warning-item--advice">
                <h2>Правила хорошего описания</h2>
                <h3>Подробности</h3>
                <p>Друзья, не используйте случайный<br>
                    контент – ни наш, ни чей-либо еще. Заполняйте свои
                    макеты, вайрфреймы, мокапы и прототипы реальным
                    содержимым.</p>
                <h3>Файлы</h3>
                <p>Если загружаете фотографии объекта, то убедитесь,
                    что всё в фокусе, а фото показывает объект со всех
                    ракурсов.</p>
            </div>
            <?php if($taskCreateModel->hasErrors()): ?>
                <?= ErrorsList::widget(['errors' => $taskCreateModel->getErrors(),
                    'labels' => $taskCreateModel->attributeLabels()]); ?>
            <?php  endif; ?>
        </div>
    </div>

    <button form="task-form" class="button" type="submit">Опубликовать</button>
</section>

