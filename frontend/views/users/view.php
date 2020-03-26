<?php

/* @var $this yii\web\View */

$this->title = 'Detail user';
//TODO разобраться с количеством звёзд рейтинга
//TODO адрес, возраст
?>

<section class="content-view">
    <div class="user__card-wrapper">
        <div class="user__card">
            <img src="<?=$userData['avatar']; ?>" width="120" height="120" alt="Аватар пользователя">
            <div class="content-view__headline">
                <h1><?=$userData['name']; ?></h1>
                <p>Россия, Санкт-Петербург, 30 лет</p>
                <div class="profile-mini__name five-stars__rate">
                    <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                    <b><?=$userData['rating']; ?></b>
                </div>
                <b class="done-task">Выполнил <?=$userData['countTask']; ?></b>
                <b class="done-review">Получил <?=$userData['countReview']; ?></b>
            </div>
            <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                <span><?=$userData['past_time']; ?></span>
                <a href="#"><b></b></a>
            </div>
        </div>
        <div class="content-view__description">
            <p><?=$userData['about']; ?></p>
        </div>
        <div class="user__card-general-information">
            <div class="user__card-info">
                <h3 class="content-view__h3">Специализации</h3>
                <div class="link-specialization">
                    <?php foreach ($userData['categories'] as $category): ?>
                        <a href="#" class="link-regular"><?=$category; ?></a>
                    <?php endforeach; ?>
                </div>
                <h3 class="content-view__h3">Контакты</h3>
                <div class="user__card-link">
                    <a class="user__card-link--tel link-regular" href="#"><?=$userData['phone']; ?></a>
                    <a class="user__card-link--email link-regular" href="#"><?=$userData['email']; ?></a>
                    <a class="user__card-link--skype link-regular" href="#"><?=$userData['skype']; ?></a>
                </div>
            </div>
            <div class="user__card-photo">
                <h3 class="content-view__h3">Фото работ</h3>
                <a href="#"><img src="./img/rome-photo.jpg" width="85" height="86" alt="Фото работы"></a>
                <a href="#"><img src="./img/smartphone-photo.png" width="85" height="86" alt="Фото работы"></a>
                <a href="#"><img src="./img/dotonbori-photo.png" width="85" height="86" alt="Фото работы"></a>
            </div>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отзывы<span>(<?=$userData['reviewsCount']; ?>)</span></h2>
        <div class="content-view__feedback-wrapper reviews-wrapper">
            <?php foreach ($reviewsData as $review): ?>
                <div class="feedback-card__reviews">
                    <p class="link-task link">Задание <a href="#" class="link-regular"><?=$review['task']; ?></a></p>
                    <div class="card__review">
                        <a href="#"><img src="<?=$review['avatar']; ?>" width="55" height="54"></a>
                        <div class="feedback-card__reviews-content">
                            <p class="link-name link"><a href="#" class="link-regular"><?=$review['name']; ?></a></p>
                            <p class="review-text"><?=$review['description']; ?></p>
                        </div>
                        <div class="card__review-rate">
                            <p class="five-rate big-rate"><?=$review['estimate']; ?><span></span></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__chat">

    </div>
</section>
