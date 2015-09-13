<?php namespace tmaciej\SlackPHP;

use tmaciej\SlackPHP\Slack;
use GuzzleHttp\Client as GuzzleClient;

class Request
{
    protected $guzzle;

    protected $token;

    protected $method;

    protected $query;

    public function __construct($method, $query = array(), $token = null)
    {
        if ($token === null) {
            $token = Slack::$defaultToken;
        }

        if ($token === null) {
            throw new \Exception('You need to specify access token for Slack API.');
        }
        $this->token = $token;

        $this->guzzle = new GuzzleClient(array(
            'base_uri' => Slack::API_URL
        ));

        $this->method = $method;

        $this->query = $this->prepareQuery($query);

        return $this;
    }

    public function execute()
    {
        $response = $this->guzzle->request('GET', $this->method, array(
            'query' => $this->query
        ));

        return $this->checkResponse($response);
    }

    public function prepareQuery($query)
    {
        $query = (array) $query;
        $query['token'] = $this->token;
        return $query;
    }

    public function checkResponse($response)
    {
        $response = json_decode($response->getBody());

        if (!$response->ok) {
            throw new \Exception('There was an error processing your request. Error: ' . $response->error);
            return false;
        }

        return $response;
    }
}
