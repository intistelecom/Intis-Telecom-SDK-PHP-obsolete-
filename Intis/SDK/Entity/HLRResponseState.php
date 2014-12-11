<?php
namespace Intis\SDK\Entity;

/**
 * Class HLRResponseState
 *
 * Class for analysis of status of subscriber by HLR request
 *
 * @package Intis\SDK\Entity
 */
class HLRResponseState{
    /**
     * @const Constant of successful status
     */
    const SUCCESS = 1;
    /**
     * @const Constant of status error
     */
    const FAILED = 2;
    
    /**
     * Analysis of the string of status by HLR request
     *
     * @param string $string
     * @return integer
     */
    public static function parse($string){
        if(strtolower($string) == 'delivrd')
            return self::SUCCESS;
        return self::FAILED;
    }
}
