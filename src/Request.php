<?php
namespace GdePosylka\Client;

use Guzzle\Common\Exception\GuzzleException;
use Guzzle\Http\Client as GuzzleClient;
use Guzzle\Http\Exception\BadResponseException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Request
{
    private $apiUrl = 'http://gdeposylka.ru/api/v4/';
    protected $apiKey = '';
    protected $guzzlePlugins = array();
    private $client;

    /**
     * @param string $apiKey
     * @param string $apiUrl
     * @param array $guzzlePlugins
     * @throws Exception\EmptyApiKey
     */
    public function __construct($apiKey, $apiUrl = '', $guzzlePlugins = array())
    {
        if (empty($apiKey)) {
            throw new Exception\EmptyApiKey();
        }
        $this->apiKey = $apiKey;
        if (!empty($apiUrl)) {
            $this->apiUrl = $apiUrl;
        }
        $this->client = new GuzzleClient();
        if (count($this->guzzlePlugins) > 0) {
            foreach ($this->guzzlePlugins as $plugin) {
                if ($plugin instanceof EventSubscriberInterface) {
                    $this->client->addSubscriber($plugin);
                }
            }
        }
    }

    /**
     * @param $method
     * @param array $params
     * @param int $id
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     * @return array|bool|float|int|string
     */
    public function call($method, $params = array(), $id = 1)
    {
        $headers = array(
            'x-authorization-token' => $this->apiKey,
        );

        try {
            $request = $this->client->get($this->apiUrl . $method . $params['tracking_number'], $headers);
            $response = $request->send()->json();
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse()->json();
        } catch (GuzzleException $exception) {
            throw $exception;
        }

        return $response;
    }

}
