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

namespace badams\GoogleUrl\Resources;

use badams\GoogleUrl\Resource;

/**
 * Class Url
 * @package badams\GoogleUrl\Resources
 * @link https://developers.google.com/url-shortener/v1/url#resource
 */
class Url extends Resource
{
    /**
     * @var string
     */
    public $kind = 'urlshortener#url';

    /**
     * Short URL, e.g. "http://goo.gl/l6MS".
     *
     * @var string
     */
    public $id;

    /**
     * Long URL, e.g. "http://www.google.com/".
     * Might not be present if the status is "REMOVED".
     *
     * @var string|null
     */
    public $longUrl;

    /**
     * Status of the target URL.
     *
     * Possible values: "OK", "MALWARE", "PHISHING", or "REMOVED".
     * A URL might be marked "REMOVED" if it was flagged as spam, for example.
     *
     * @var string
     */
    public $status;

    /**
     * Time the short URL was created; ISO 8601 representation using the
     * yyyy-MM-dd'T'HH:mm:ss.SSSZZ format e.g. "2010-10-14T19:01:24.944+00:00".
     *
     * @var string|null
     */
    public $created;

    /**
     * A summary of the click analytics for the short and long URL.
     * Might not be present if not requested or currently unavailable.
     *
     * @var Analytics|null
     */
    public $analytics;

    /**
     * @param \stdClass $json
     */
    public function setAnalytics($json)
    {
        $this->analytics = Analytics::createFromJson($json);
    }
}
