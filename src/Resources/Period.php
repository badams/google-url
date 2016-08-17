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

use \badams\GoogleUrl\Resource;

/**
 * Class Analytics
 * @package badams\GoogleUrl\Resources
 */
class Period extends Resource
{
    /**
     * Number of clicks on this short URL.
     *
     * @var integer
     */
    public $shortUrlClicks;

    /**
     * Number of clicks on all goo.gl short URLs pointing to this long URL.
     *
     * @var integer
     */
    public $longUrlClicks;

    /**
     * Top referring hosts, e.g. "www.google.com"; sorted by (descending) click counts. Only present if this data is available.
     *
     * @var Category[]
     */
    public $referrers = [];

    /**
     * Top countries (expressed as country codes), e.g. "US" or "DE"; sorted by (descending) click counts. Only present if this data is available.
     *
     * @var Category[]
     */
    public $countries = [];

    /**
     * Top browsers, e.g. "Chrome"; sorted by (descending) click counts. Only present if this data is available.
     *
     * @var Category[]
     */
    public $browsers = [];

    /**
     * Top platforms or OSes, e.g. "Windows"; sorted by (descending) click counts. Only present if this data is available.
     *
     * @var Category[]
     */
    public $platforms = [];

    /**
     * Populates the referrers list
     *
     * @param $list
     */
    public function setReferrers($list)
    {
        foreach ($list as $category) {
            $this->referrers[] = Category::createFromJson($category);
        }
    }

    /**
     * Populates the countries list
     *
     * @param $list
     */
    public function setCountries($list)
    {
        foreach ($list as $category) {
            $this->countries[] = Category::createFromJson($category);
        }
    }

    /**
     * Populates the browsers list
     *
     * @param $list
     */
    public function setBrowsers($list)
    {
        foreach ($list as $category) {
            $this->browsers[] = Category::createFromJson($category);
        }
    }

    /**
     * Populates the platforms list
     *
     * @param $list
     */
    public function setPlatforms($list)
    {
        foreach ($list as $category) {
            $this->platforms[] = Category::createFromJson($category);
        }
    }
}
