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
 * Class Category
 * @package badams\GoogleUrl\Resources
 */
class Category extends Resource
{
    /**
     * Label assigned to this top entry, e.g. "US" or "Chrome".
     *
     * @var string
     */
    public $id;

    /**
     * Number of clicks for this top entry, e.g. for this particular country or browser.
     *
     * @var integer
     */
    public $count;
}
