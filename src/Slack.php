<?php namespace tmaciej\Slack;

use tmaciej\Slack\Client;

class Slack
{
    const API_URL = 'https://slack.com/api/';

    public static $defaultToken = null;

    public static function setDefaultToken($token)
    {
        self::$defaultToken = $token;
    }
}
