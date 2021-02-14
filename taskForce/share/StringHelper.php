<?php

namespace taskForce\share;
use DateTime;

class StringHelper
{
    public static function declensionNum($number,$titles)
    {
        $cases = [2, 0, 1, 1, 1, 2];
        $format = $titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];

        return sprintf($format, $number);
    }

    public static function getPastActivityTime($dateTime)
    {
        $time = new \DateTime($dateTime);
        $currentTime = new \DateTime();
        $interval = $time->diff($currentTime);
        if($interval->days > 0) {
            return StringHelper::declensionNum(
                $interval->days,
                ['Был на сайте %d день назад', 'Был на сайте %d дня назад', 'Был на сайте %d дней назад']
            );
        }
        if($interval->days === 0 && $interval->h !== 0) {
            return StringHelper::declensionNum(
                $interval->h,
                ['Был на сайте %d час назад', 'Был на сайте %d часа назад', 'Был на сайте %d часов назад']
            );
        }
        if($interval->days === 0 && $interval->h === 0) {
            return StringHelper::declensionNum(
                $interval->i,
                ['Был на сайте %d минуту назад', 'Был на сайте %d минуты назад', 'Был на сайте %d минут назад']
            );
        }
    }

    public static function getPastTime($dateTime)
    {
        $time = new \DateTime($dateTime);
        $currentTime = new \DateTime();
        $interval = $time->diff($currentTime);
        if($interval->days > 0) {
            return StringHelper::declensionNum(
                $interval->days,
                ['%d день назад', '%d дня назад', '%d дней назад']
            );
        }
        if($interval->days === 0 && $interval->h !== 0) {
            return StringHelper::declensionNum(
                $interval->h,
                ['%d час назад', '%d часа назад', '%d часов назад']
            );
        }
        if($interval->days === 0 && $interval->h === 0) {
            return StringHelper::declensionNum(
                $interval->i,
                ['%d минуту назад', '%d минуты назад', '%d минут назад']
            );
        }
    }

    public static function getRegistrationPastTime($dateTime)
    {
        $time = new \DateTime($dateTime);
        $currentTime = new \DateTime();
        $interval = $time->diff($currentTime);
        if($interval->y > 0) {
            return StringHelper::declensionNum(
                $interval->y,
                ['%d год', '%d года', '%d лет']
            );
        }
        if($interval->days > 0) {
            return StringHelper::declensionNum(
                $interval->days,
                ['%d день', '%d дня', '%d дней']
            );
        }
        if($interval->days === 0 && $interval->h !== 0) {
            return StringHelper::declensionNum(
                $interval->h,
                ['%d час', '%d часа', '%d часов']
            );
        }
    }

    public static function getAge(DateTime $dateTime)
    {
        $interval = $dateTime->diff(new DateTime());
        if($interval->y > 0) {
            return StringHelper::declensionNum(
                $interval->y,
                ['%d год', '%d года', '%d лет']
            );
        }
    }
}

