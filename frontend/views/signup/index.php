<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = 'Регистрация';
$cities = \yii\helpers\ArrayHelper::map($city,'id','name');
//TODO Выяснить, почему не работает required на стороне сервера
?>

<section class="registration__user">
    <h1>Регистрация аккаунта</h1>
    <div class="registration-wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            'method' => 'POST',
            'action' => 'signup',
            'options' => ['class' => 'registration__user-form form-create','enctype' => 'multipart/form-data'],
            'enableClientValidation' => false,
            'fieldConfig' => ['options' => ['tag' => false],'template' => "{label}\n{input}\n{error}"],
//            'fieldConfig' => ['errorOptions' => ['encode' => false, 'class' => 'help-block']]
        ]); ?>
        <?=$form->field($signUpModel,'email')
        ->input('email',array(
                'placeholder' => 'kumarm@mail.ru',
                'id' => '16',
                'class' => 'input textarea',
                'rows' => '1',
                'required' => true
            ))
            ->label("Электронная почта"); ?>
        <span>Введите валидный адрес электронной почты</span>
        <?=$form->field($signUpModel,'userName')
            ->textInput(array(
                'class' => 'input textarea',
                'id' => '17',
                'placeholder' => 'Мамедов Кумар',
                'rows' => '1',
                'required' => true
            ))
            ->label('Ваше имя'); ?>
        <span>Введите ваше имя и фамилию</span>
        <?=$form->field($signUpModel,'city')
            ->dropDownList($cities,array(
                    'id' => '18',
                    'class' => 'multiple-select input town-select registration-town',
                    'size' => '1'))
            ->label('Город проживания') ?>
        <span>Укажите город, чтобы находить подходящие задачи</span>
        <?=$form->field($signUpModel,'password',[])
            ->passwordInput(array(
                'id' => '19',
                'class' => 'input textarea',
                'required' => true
            ))
            ->label('Пароль',array('class' => 'input-danger')); ?>
        <span>Длина пароля от 8 символов</span>
        <?= Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>

