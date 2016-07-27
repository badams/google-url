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

/**
 * Class UrlResource
 * @package badams\GoogleUrl
 * @link https://developers.google.com/url-shortener/v1/url#resource
 */
class UrlResource implements \JsonSerializable
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
     * @param \stdClass $json
     * @return UrlResource
     */
    public static function createFromJson(\stdClass $json)
    {
        $resource = new UrlResource();
        $class = new \ReflectionClass($resource);

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (isset($json->{$property->getName()})) {
                $resource->{$property->getName()} = $json->{$property->getName()};
            }
        }

        return $resource;
    }

    /**
     * Serialize this resource into an array for json
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $class = new \ReflectionClass($this);
        $json = [];

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (null !== ($value = $property->getValue($this))) {
                $json[$property->getName()] = $value;
            }
        }

        return $json;
    }
}