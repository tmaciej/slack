<?php namespace tmaciej\Slack\Chat;

use tmaciej\Slack\Request;
use tmaciej\Slack\Channels\Finder;

class Message
{
    protected $channels = array();

    protected $finder;

    public function __construct()
    {
        $this->finder = new Finder();
    }

    public function send($text, $channels, $username = 'DefaultBOT')
    {
        if (!is_array($channels)) {
            $channels = (array) $channels;
        }

        $channels = array_merge($this->channels, $channels);

        foreach ($channels as $channel) {
            if (strpos($channel, '#') === 0) {
                $id = $this->finder->find($channel);
            } else {
                $id = $channel;
            }

            if ($id !== null) {
                $request = new Request('chat.postMessage', array(
                    'channel' => $id,
                    'text' => $text,
                    'username' => $username
                ));

                $request->execute();
                unset($request);
            }
        }
    }
}
