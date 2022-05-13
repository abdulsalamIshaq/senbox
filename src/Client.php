<?php

namespace AbdulsalamIshaq\Sendbox;

use GuzzleHttp\Client as Guzzle;
use AbdulsalamIshaq\Sendbox\HttpClient\HttpClientInterface;
use AbdulsalamIshaq\Sendbox\HttpClient\SendHttpRequests;

class Client implements HttpClientInterface
{
    use SendHttpRequests;

    /**
     * Base url of termii api
     * @var string
     */
    public $url = 'https://live.sendbox.co/';

    /**
     * User agent for the HTTP client
     * @var string
     */
    protected $userAgent = 'Sendbox Library: abdulsalamishaq/sendbox';

    /**
     * Secret Key for Sendbox api
     * @var string
     */
    protected $access_token;

    public function __construct(string $access_token, array $options = null)
    {
        $this->access_token = $access_token;

        if (isset($options)) $this->fillOptions($options);

        $this->httpClient = new Guzzle([
            // Base URI is used with relative requests
            'base_uri' => $this->baseUri(),
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);
    }

    /**
     * Mass fill the client option
     * 
     * @since 1.0
     * 
     * @param array $options Associate Array contating the options
     * @return static $this Return the client object for method chaining
     */
    public function fillOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (is_string($key) && property_exists($this, $key)) $this->{$key} = $value;
        }
        return $this;
    }

    /**
     * Dynamic property to get the api handlers
     * 
     * @since 1.0
     * 
     * @param string $tag Endpoint Tag Name
     */
    public function __get(string $tag)
    {
        return $this->api($tag);
    }

    /**
     * Get the endpoint handler through tag name
     * 
     * @since 1.0
     * 
     * @param string $tag Endpoint Tag Name
     */
    public function api(string $tag)
    {
        $class = $this->getEndpointHandler($tag);

        return new $class($this);
    }

    /**
     * Get the endpoint handler class name through tag name
     * 
     * @since 1.0
     * 
     * @param string $tag Endpoint Tag Name
     */
    protected function getEndpointHandler(string $tag)
    {
        $map = $this->apiMap();

        if (isset($map[$tag])) {
            return $map[$tag];
        }

        throw new \Exception("The [$tag] is not a valid Endpoint tag.");
    }

    /**
     * Get the base URI of the client
     * 
     * @since 1.0
     * 
     * @return string
     */
    public function baseUri()
    {
        return $this->url;
    }

    /**
     * Get the acess token of the client
     * 
     * @since 1.0
     * 
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Get the http client
     * 
     * @since 1.0
     * 
     * @return string
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Get the user agent for the http client
     * @since 1.0
     * 
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function apiMap()
    {
        return [
            'auth' => \AbdulsalamIshaq\Sendbox\Api\Auth::class,
            'shipment' => \AbdulsalamIshaq\Sendbox\Api\Shipment::class,
            'payment' => \AbdulsalamIshaq\Sendbox\Api\Payment::class,
        ];
    }

}