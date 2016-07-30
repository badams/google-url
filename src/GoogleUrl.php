<?php
/**
 * This file is part of the badams\GoogleUrl library
 *
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/badams/google-url
 * @package badams/google-url
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace badams\GoogleUrl;

use badams\GoogleUrl\Actions\Shorten;
use badams\GoogleUrl\Exceptions\GoogleUrlException;
use badams\GoogleUrl\Exceptions\InvalidKeyException;
use badams\GoogleUrl\Exceptions\InvalidValueException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;

/**
 * Class GoogleUrl
 * @package badams\GoogleUrl
 */
class GoogleUrl
{
    /**
     *
     */
    const BASE_URL = 'https://www.googleapis.com/urlshortener/v1/url';

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $http;

    /**
     * @var
     */
    private $key;

    /**
     * GoogleUrl constructor.
     * @param $key
     * @param \GuzzleHttp\ClientInterface|null $httpClient
     */
    public function __construct($key, ClientInterface $httpClient = null)
    {
        if (is_null($httpClient)) {
            $httpClient = new Client();
        }

        $this->setKey($key);
        $this->http = $httpClient;
    }

    /**
     * @param $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param ActionInterface $method
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    private function createRequest(ActionInterface $method)
    {
        return $this->http->createRequest(
            $method->getRequestMethod(),
            self::BASE_URL,
            array_merge([
                'exceptions' => false,
                'headers' => ['Content-Type' => 'application/json'],
                'query' => ['key' => $this->key],
            ], $method->getRequestOptions())
        );
    }

    /**
     * @param ActionInterface $method
     * @return mixed
     */
    private function execute(ActionInterface $method)
    {
        $response = $this->http->send($this->createRequest($method));

        if ($response->getStatusCode() !== 200) {
            $json = json_decode($response->getBody()->getContents());
            if (isset($json->error) && is_array($json->error->errors)) {
                $this->assertInvalidKey($json);
                $this->assertInvalidValue($json);
            } // @codeCoverageIgnore
            throw new GoogleUrlException($response->getBody());
        }

        return $method->processResponse($response);
    }

    /**
     * @param $response
     * @throws InvalidKeyException
     */
    private function assertInvalidKey($response)
    {
        if ($response->error->errors[0]->reason === 'keyInvalid') {
            throw new InvalidKeyException;
        }
    }

    /**
     * @param $response
     */
    private function assertInvalidValue($response)
    {
        if (
            $response->error->errors[0]->message === 'Invalid Value' &&
            $response->error->errors[0]->locationType === 'parameter'
        ) {
            throw new InvalidValueException($response->error->errors[0]->location);
        }
    } // @codeCoverageIgnore

    /**
     * @param $longUrl
     * @return UrlResource
     */
    public function shorten($longUrl)
    {
        return $this->execute(new Shorten($longUrl));
    }
}
