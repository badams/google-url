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

use badams\GoogleUrl\Exceptions\GoogleUrlException;
use badams\GoogleUrl\Resources\Url;
use badams\GoogleUrl\ActionInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Class Shorten
 * @package badams\GoogleUrl\Actions
 * @link https://developers.google.com/url-shortener/v1/url/insert
 */
class Expand implements ActionInterface
{
    /**
     * @var string
     */
    protected $shortUrl;

    /**
     * Shorten constructor.
     * @param $shortUrl
     * @throws GoogleUrlException
     * @internal param $longUrl
     */
    public function __construct($shortUrl)
    {
        if (empty($shortUrl)) {
            throw new GoogleUrlException('No URL provided');
        }

        $this->shortUrl = $shortUrl;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return 'GET';
    }

    /**
     * @return array
     */
    public function getRequestOptions()
    {
        return [
            'query' => ['shortUrl' => $this->shortUrl]
        ];
    }

    /**
     * @param ResponseInterface $response
     * @return Url
     */
    public function processResponse(ResponseInterface $response)
    {
        $obj = json_decode($response->getBody()->getContents());
        return Url::createFromJson($obj);
    }
}
