<?php namespace tmaciej\SlackPHP\Channels;

use tmaciej\SlackPHP\Request;

class Finder
{
    protected $channels = null;

    public function getChannels()
    {
        if ($this->channels === null) {
            $request = new Request('channels.list');
            $response = $request->execute();
            $this->channels = $response->channels;
        }

        return $this->channels;
    }

    public function find($name)
    {
        $name = substr($name, 1);

        foreach ($this->getChannels() as $channel) {
            if ($channel->name === $name) {
                return $channel->id;
            }
        }

        return null;
    }
}
