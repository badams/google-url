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

namespace badams\GoogleUrl\Actions;

/**
 * Class Detect
 * @package badams\GoogleUrl\Actions
 * @link https://developers.google.com/url-shortener/v1/url/insert
 */
class Shorten implements \badams\GoogleUrl\ActionInterface
{
    /**
     * @var string
     */
    protected $longUrl;

    /**
     * Shorten constructor.
     * @param $longUrl
     */
    public function __construct($longUrl)
    {
        $this->longUrl = $longUrl;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getRequestOptions()
    {
        return [
            'body' => [
                'kind' =>'urlshortener#url',
                'longUrl' => $this->longUrl
            ]
        ];
    }

    /**
     * @param \GuzzleHttp\Message\ResponseInterface $response
     * @return string
     */
    public function processResponse(\GuzzleHttp\Message\ResponseInterface $response)
    {
        $obj = json_decode($response->getBody()->getContents());
        return $obj->id;
    }
}
