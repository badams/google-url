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
 * Class Analytics
 * @package badams\GoogleUrl\Resources
 * @link https://developers.google.com/url-shortener/v1/url#resource
 */
class Analytics extends Resource
{
    /**
     *
     */
    const FULL = 'FULL';

    /**
     *
     */
    const TOP = 'ANALYTICS_TOP_STRINGS';

    /**
     *
     */
    const CLICKS = 'ANALYTICS_CLICKS';

    /**
     * Click analytics for all time
     *
     * @var Period
     */
    public $allTime;

    /**
     * Click analytics over the last month.
     *
     * @var Period
     */
    public $month;

    /**
     * Click analytics over the last week.
     *
     * @var Period
     */
    public $week;

    /**
     * Click analytics over the last day.
     *
     * @var Period
     */
    public $day;

    /**
     * Click analytics over the last two hours.
     *
     * @var Period
     */
    public $twoHours;

    /**
     * Populate analytics for all time
     *
     * @param \stdClass $data
     */
    public function setAllTime(\stdClass $data)
    {
        $this->allTime = Period::createFromJson($data);
    }

    /**
     * Populate analytics for last month
     *
     * @param \stdClass $data
     */
    public function setMonth(\stdClass $data)
    {
        $this->month = Period::createFromJson($data);
    }

    /**
     * Populate analytics for last week
     *
     * @param \stdClass $data
     */
    public function setWeek(\stdClass $data)
    {
        $this->week = Period::createFromJson($data);
    }

    /**
     * Populate analytics for last day
     *
     * @param \stdClass $data
     */
    public function setDay(\stdClass $data)
    {
        $this->day = Period::createFromJson($data);
    }

    /**
     * Populate analytics for last two hours
     *
     * @param \stdClass $data
     */
    public function setTwoHours(\stdClass $data)
    {
        $this->twoHours = Period::createFromJson($data);
    }
}
