<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use frontend\models\SignUpModel;

/** @var $this yii\web\View
 * @var $signUpModel SignUpModel
 */

$this->title = 'Регистрация';
$this->params['isRegisterPage'] = true;
$cities = \yii\helpers\ArrayHelper::map($city,'id','name');

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
        ]); ?>
        <?= $form->field($signUpModel,'email')
        ->input('email',array(
                'placeholder' => 'kumarm@mail.ru',
                'class' => 'input textarea',
                'rows' => '1',
                'required' => true
            ));
        ?>
        <span>Введите валидный адрес электронной почты</span>
        <?= $form->field($signUpModel,'userName')
            ->textInput(array(
                'class' => 'input textarea',
                'placeholder' => 'Мамедов Кумар',
                'rows' => '1',
                'required' => true
            ));
        ?>
        <span>Введите ваше имя и фамилию</span>
        <?= $form->field($signUpModel,'city')
            ->dropDownList($cities,array(
                    'class' => 'multiple-select input town-select registration-town',
                    'size' => '1'));
        ?>
        <span>Укажите город, чтобы находить подходящие задачи</span>
        <?= $form->field($signUpModel,'password',['labelOptions' => ['class' => 'input-danger']])
            ->passwordInput(array(
                'class' => 'input textarea',
                'required' => true,
            ));
            ?>
        <span>Длина пароля от 8 символов</span>
        <?= Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>

<?php $this->beginBlock('woman'); ?>
    <div class="clipart-woman">
        <img src="./img/clipart-woman.png" width="238" height="450">
    </div>
    <div class="clipart-message">
        <div class="clipart-message-text">
            <h2>Знаете ли вы, что?</h2>
            <p>После регистрации вам будет доступно более
                двух тысяч заданий из двадцати разных категорий.</p>
            <p>В среднем, наши исполнители зарабатывают
                от 500 рублей в час.</p>
        </div>
    </div>
<?php $this->endBlock(); ?>
