<?php namespace tmaciej\SlackPHP;

class Slack
{
    const API_URL = 'https://slack.com/api/';

    public static $defaultToken = null;

    public static function setDefaultToken($token)
    {
        self::$defaultToken = $token;
    }
}
