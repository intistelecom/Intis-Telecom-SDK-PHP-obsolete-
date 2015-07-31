<?php
namespace Intis\SDK\Entity;

/**
 * Class MessageState
 *
 * Class of analysis of message status
 *
 * @package Intis\SDK\Entity
 */
class MessageState {

    /**
     * @const Constant for scheduled message
     */
    const SCHEDULED = 0;
    /**
     * @const Constant for the message with ENROUTE status
     */
    const ENROUTE = 1;
    /**
     * @const Constant for delivered message
     */
    const DELIVERED = 2;
    /**
     * @const Constant for expired message
     */
    const EXPIRED = 3;
    /**
     * @const Constant for deleted message
     */
    const DELETED = 4;
    /**
     * @const Constant for undelivered message
     */
    const UNDELIVERABLE = 5;
    /**
     * @const Constant for sent message
     */
    const ACCEPTED = 6;
    /**
     * @const Constant for unknown message
     */
    const UNKNOWN = 7;
    /**
     * @const Constant for rejected message
     */
    const REJECTED = 8;
    /**
     * @const Constant for missed message
     */
    const SKIPPED = 9;

    /**
     * Analysis of the string of message status
     *
     * @param string $state message status
     * @return type
     */
    public static function parse($state) {
        switch ($state) {
            case 'deliver':
                return self::DELIVERED;
            case 'expired':
                return self::EXPIRED;
            case 'not_deliver':
                return self::UNDELIVERABLE;
            case 'partly_deliver':
                return self::ACCEPTED;
            default:
                return null;
        }
    }
}
