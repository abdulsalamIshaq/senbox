<?php

namespace AbdulsalamIshaq\Sendbox\Api;

use AbdulsalamIshaq\Sendbox\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * @property $client The sendbox client intance
 */
class AbstractApi
{

    /**
     * The sendbox client instance
     * @var \AbdulsalamIshaq\Sendbox
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle GET method
     * 
     * @since 1.0
     * 
     * @param string $route
     * @param array $parameters
     * @return \GuzzleHttp\Response
     */
    public function get(string $route, array $parameters = [null])
    {
        return $this->client->get($route, $parameters);
    }

    /**
     * Handle POST method
     * 
     * @since 1.0
     * 
     * @param string $route
     * @param array $body
     * @return \GuzzleHttp\Response
     */
    public function post(string $route, array $body)
    {
        return $this->client->post($route, $body);
    }

    /**
     * Handle PUT method
     * 
     * @since 1.0
     * 
     * @param string $route
     * @param array $body
     * @return \GuzzleHttp\Response
     */
    public function put(string $route, array $body = [null])
    {
        return $this->client->put($route, $body);
    }

    /**
     * Handle DELETE method
     * 
     * @since 1.0
     * 
     * @param string $route
     * @param array $parameters
     * @return \GuzzleHttp\Response
     */
    public function delete(string $route, array $parameters = [null])
    {
        return $this->client->delete($route, $parameters);
    }

    /**
     * Change a response instance to array
     * 
     * @since 1.0
     * 
     * @param ResponseInterface $response
     * @return array
     */
    public function responseArray(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();
        // print_r($body);
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
        }

        return $body;
    }
}
