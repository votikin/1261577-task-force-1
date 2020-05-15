<?php

/* @var $this yii\web\View
 * @var $responsesData
 * @var $taskData
 * @var $customerData
 * @var $isExecutor bool
 */

use frontend\components\widgets\ResponsesButtons;
use frontend\models\TaskStatus;
use frontend\components\widgets\StarsWidget;
use yii\helpers\Url;

$this->title = 'Detail task';
$currentUserId = Yii::$app->user->getId();

//TODO отработать вложения, адрес
//TODO я бы убрал таблицу роль из бд, добавил бы поле boolean в user
//TODO работа с файлами, связанными с заданием и юзером (изображения)
?>

<?php $this->beginBlock('responses'); ?>

    <div class="content-view__feedback">
        <h2>Отклики <span>(<?= count($responsesData); ?>)</span></h2>
        <div class="content-view__feedback-wrapper">
            <?php foreach ($responsesData as $response): ?>
                <?php $userUrl = Url::to(['users/view', 'id' => $response['user']['id']]) ?>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="<?= $userUrl; ?>"><img src="<?= $response['user']['avatar']; ?>" width="55" height="55"></a>
                        <div class="feedback-card__top--name">
                            <p><a href="<?= $userUrl; ?>" class="link-regular"><?= $response['user']['name']; ?></a></p>
<!--                            <span></span><span></span><span></span><span></span><span class="star-disabled"></span>-->
                            <?= StarsWidget::widget(['rating' => $response['user']['rating']]); ?>
                            <b><?= $response['user']['rating']; ?></b>
                        </div>
                        <span class="new-task__time"><?= $response['pastTime']; ?></span>
                    </div>
                    <div class="feedback-card__content">
                        <p><?= $response['comment']; ?></p>
                        <span><?= $response['price']; ?> ₽</span>
                    </div>
                    <?php if ($currentUserId === $customerData['user']['id'] &&
                        $response['isDeleted'] == 0 &&
                        $taskData['status']['name'] === TaskStatus::NAME_STATUS_NEW): ?>
                        <?= ResponsesButtons::widget(['response' => $response, 'task' => $taskData['id']]) ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php $this->endBlock(); ?>


<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">
                    <h1><?= $taskData['short']; ?></h1>
                    <span>Размещено в категории
                                    <a href="#" class="link-regular"><?= $taskData['category']['name']; ?></a>
                                    <?= $taskData['pastTime']; ?></span>
                </div>
                <b class="new-task__price new-task__price--<?= $taskData['category']['icon']; ?> content-view-price">
                    <?= $taskData['budget']; ?><b> ₽</b>
                </b>
                <div class="new-task__icon new-task__icon--<?= $taskData['category']['icon']; ?> content-view-icon"></div>
            </div>
            <div class="content-view__description">
                <h3 class="content-view__h3">Общее описание</h3>
                <p><?= $taskData['description']; ?></p>
            </div>
            <div class="content-view__attach">
                <h3 class="content-view__h3">Вложения</h3>
                <?php foreach ($taskData['images'] as $image): ?>
                <a href="<?= $image['path']; ?>" target="_blank"><?= basename($image['path']); ?></a>
                <?php endforeach; ?>
            </div>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                         alt="Москва, Новый арбат, 23 к. 1"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town">Москва</span><br>
                        <span>Новый арбат, 23 к. 1</span>
                        <p>Вход под арку, код домофона 1122</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-view__action-buttons">
            <button class=" button button__big-color response-button open-modal"
                    type="button" data-for="response-form">Откликнуться</button>
            <button class="button button__big-color refusal-button open-modal"
                    type="button" data-for="refuse-form">Отказаться</button>
            <button class="button button__big-color request-button open-modal"
                    type="button" data-for="complete-form">Завершить</button>
        </div>
    </div>
    <?php if ($currentUserId === $customerData['user']['id'] || $isExecutor === true): ?>
        <?= $this->blocks['responses']; ?>
    <?php endif; ?>

</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <img src="<?= $customerData['user']['avatar']; ?>" width="62" height="62" alt="Аватар заказчика">
                <div class="profile-mini__name five-stars__rate">
                    <p><?= $customerData['user']['name']; ?></p>
                </div>
            </div>
            <p class="info-customer"><span><?= $customerData['countTasks']; ?> заданий</span><span class="last-"><?= $customerData['user']['registrationPast']; ?> на сайте</span></p>
            <a href="#" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
    <div class="connect-desk__chat">
        <h3>Переписка</h3>
        <div class="chat__overflow">
            <div class="chat__message chat__message--out">
                <p class="chat__message-time">10.05.2019, 14:56</p>
                <p class="chat__message-text">Привет. Во сколько сможешь
                    приступить к работе?</p>
            </div>
            <div class="chat__message chat__message--in">
                <p class="chat__message-time">10.05.2019, 14:57</p>
                <p class="chat__message-text">На задание
                    выделены всего сутки, так что через час</p>
            </div>
            <div class="chat__message chat__message--out">
                <p class="chat__message-time">10.05.2019, 14:57</p>
                <p class="chat__message-text">Хорошо. Думаю, мы справимся</p>
            </div>
        </div>
        <p class="chat__your-message">Ваше сообщение</p>
        <form class="chat__form">
            <textarea class="input textarea textarea-chat" rows="2" name="message-text" placeholder="Текст сообщения"></textarea>
            <button class="button chat__button" type="submit">Отправить</button>
        </form>
    </div>
</section>

<section class="modal response-form form-modal" id="response-form">
    <h2>Отклик на задание</h2>
    <form action="#" method="post">
        <p>
            <label class="form-modal-description" for="response-payment">Ваша цена</label>
            <input class="response-form-payment input input-middle input-money" type="text" name="response-payment" id="response-payment">
        </p>
        <p>
            <label class="form-modal-description" for="response-comment">Комментарий</label>
            <textarea class="input textarea" rows="4" id="response-comment" name="response-comment" placeholder="Place your text"></textarea>
        </p>
        <button class="button modal-button" type="submit">Отправить</button>
    </form>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
<section class="modal completion-form form-modal" id="complete-form">
    <h2>Завершение задания</h2>
    <p class="form-modal-description">Задание выполнено?</p>
    <form action="#" method="post">
        <input class="visually-hidden completion-input completion-input--yes" type="radio" id="completion-radio--yes" name="completion" value="yes">
        <label class="completion-label completion-label--yes" for="completion-radio--yes">Да</label>
        <input class="visually-hidden completion-input completion-input--difficult" type="radio" id="completion-radio--yet" name="completion" value="difficulties">
        <label  class="completion-label completion-label--difficult" for="completion-radio--yet">Возникли проблемы</label>
        <p>
            <label class="form-modal-description" for="completion-comment">Комментарий</label>
            <textarea class="input textarea" rows="4" id="completion-comment" name="completion-comment" placeholder="Place your text"></textarea>
        </p>
        <p class="form-modal-description">
            Оценка
        <div class="feedback-card__top--name completion-form-star">
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
        </div>
        </p>
        <input type="hidden" name="rating" id="rating">
        <button class="button modal-button" type="submit">Отправить</button>
    </form>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
<section class="modal form-modal refusal-form" id="refuse-form">
    <h2>Отказ от задания</h2>
    <p>
        Вы собираетесь отказаться от выполнения задания.
        Это действие приведёт к снижению вашего рейтинга.
        Вы уверены?
    </p>
    <button class="button__form-modal button" id="close-modal"
            type="button">Отмена</button>
    <button class="button__form-modal refusal-button button"
            type="button">Отказаться</button>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>


