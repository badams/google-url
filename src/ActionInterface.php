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
 * Interface ActionInterface
 * @package badams\GoogleUrl
 */
interface ActionInterface
{
    /**
     * @return string
     */
    public function getRequestMethod();

    /**
     * @return array
     */
    public function getRequestOptions();

    /**
     * @param \GuzzleHttp\Message\ResponseInterface $response
     * @return mixed
     */
    public function processResponse(\GuzzleHttp\Message\ResponseInterface $response);
}
