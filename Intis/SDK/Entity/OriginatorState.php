<?php
namespace Intis\SDK\Entity;

/**
 * Class OriginatorState
 *
 * Class for analysis sender status
 *
 * @package Intis\SDK\Entity
 */
class OriginatorState{
    /**
     * @const Constant for approved sender
     */
    const COMPLETED = 1;
    /**
     * @const Constant for the sender that is in moderation queue
     */
    const MODERATION = 2;
    /**
     * @const Constant of the rejected message
     */
    const REJECTED = 3;

    /**
     * Analysis of the string of sender status
     *
     * @param string $string Sender's status
     * @return integer
     */
    public static function parse($string){
          if ($string == 'completed'){
                return self::COMPLETED;
          }
          else if ($string == 'order'){
                return self::MODERATION;
          }
          else if ($string == 'rejected'){
                return self::REJECTED;
          }
          return null;
    }
}