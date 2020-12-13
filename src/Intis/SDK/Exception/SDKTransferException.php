<?php

namespace Intis\SDK\Exception;

/**
 * This exception helps distinguish response exceptions from other that happen
 * due to invalid API client configuration or network issues - when it's not possible
 * to connect server physically (or server is down).
 *
 * Happens when:
 * - HTTP error occurs (4xx or 5xx error)
 * - connection cannot be established
 * - too many redirects from server
 */
class SDKTransferException extends \RuntimeException implements ExceptionInterface
{
}
