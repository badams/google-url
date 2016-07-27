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
     * MicrosoftTranslator constructor.
     */
    public function __construct(\GuzzleHttp\ClientInterface $httpClient = null)
    {
        if (is_null($httpClient)) {
            $httpClient = new \GuzzleHttp\Client();
        }

        $this->http = $httpClient;
    }

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

        if ($response->getStatusCode() != 200) {
            throw new TranslatorException($response->getBody());
        }

        return $method->processResponse($response);
    }

    /**
     * @param $longUrl
     * @return mixed
     */
    public function shorten($longUrl)
    {
        return $this->execute(new Shorten($longUrl));
    }
}
