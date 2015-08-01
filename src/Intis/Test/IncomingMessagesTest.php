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
        $date = '2014-11-25';
        $result = $client->getIncomingMessages($date);

        foreach($result as $one){
            $one->getMessageId();
            $one->getOriginator();
            $one->getPrefix();
            $one->getReceivedAt();
            $one->getText();
        }

        $this->assertInternalType('array',$result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\IncomingMessage',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\IncomingMessageException
     */
    public function test_getOriginatorsException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $date = '2014-11-25';
        $client->getIncomingMessages($date);
    }
}
