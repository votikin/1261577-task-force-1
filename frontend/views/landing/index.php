<?php
/** @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Landing';
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'method' => 'POST',
    'fieldConfig' => ['template' => "{label}\n{input}\n{error}"],
    'enableAjaxValidation' => true,
]); ?>
<?=$form->field($loginForm,'email',['labelOptions' => ['class' => 'form-modal-description']])
    ->input('email',array(
        'placeholder' => 'kumarm@mail.ru',
        'class' => 'enter-form-email input input-middle',
        'required' => true
    ));
?>
<?=$form->field($loginForm,'password',['labelOptions' => ['class' => 'form-modal-description']])
    ->passwordInput(array(
        'class' => 'enter-form-email input input-middle',
        'required' => true,
    ));
?>
<?= Html::submitButton('Войти') ?>
<?php ActiveForm::end(); ?>

