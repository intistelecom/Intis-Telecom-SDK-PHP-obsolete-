<?php
namespace Intis\SDK\Entity;

/**
 * Class Gender
 *
 * Getting gender of subscriber
 *
 * @package Intis\SDK\Entity
 */
class Gender{
    /**
     * @const Constant for male
     */
    const MALE = 1;
    /**
     * @const Constant for female
     */
    const FEMALE = 2;
    /**
     * @const Constant for undefined gender
     */
    const UNDEFINED = 3;
    
    /**
     * Parsing a string for getting gender of subscriber
     *
     * @param string $string
     * @return integer
     */
    public static function parse($string){
        switch ($string){
            case 'm':
                return self::MALE;
            case 'f':
                return self::FEMALE;
            default :
                return self::UNDEFINED;
        }
    }
}
