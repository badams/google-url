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

namespace badams\GoogleUrl\Exceptions;

class InvalidKeyException extends GoogleUrlException
{
    /**
     * InvalidKeyException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = 'Invalid API key', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
