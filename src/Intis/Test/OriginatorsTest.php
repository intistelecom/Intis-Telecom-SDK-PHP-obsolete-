<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2015
 * Time: 21:52
 */


namespace Intis\Test;

require  '../../../vendor/autoload.php';

use Intis\SDK\IntisClient;


class OriginatorsTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getOriginators(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $originators = $client->getOriginators();

        foreach($originators as $originator){
            $originator->getOriginator();
            $originator->getState();
        }

        $this->assertInternalType('array',$originators);
        $first = $originators[0];
        $this->assertInstanceOf('Intis\SDK\Entity\Originator',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\OriginatorException
     */
    public function test_getOriginatorsException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $client->getOriginators();
    }
}
