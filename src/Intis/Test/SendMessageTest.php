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


class SendMessageTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_sendMessage(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phone = array('79009009090','79009009091');
        /*
         * || $phone = '79009009090,79009009091,79009009092'
         */
        $originator = "smstest";
        $text = "test message";
        $messages = $client->sendMessage($phone, $originator, $text);

        foreach($messages as $one){
            $one->getPhone();
            $one->getMessageId();
            $one->getCost();
            $one->getMessagesCount();
            $one->getError();
        }

        $this->assertInternalType('array',$messages);
        $first = $messages[0];
        $this->assertInstanceOf('Intis\SDK\Entity\MessageSendingResult',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\MessageSendingResultException
     */
    public function test_getBalanceException(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phone = array('79009009090','79009009091');
        /*
         * || $phone = '79009009090,79009009091,79009009092'
         */
        $originator = 'test';
        $text = 'test message';
        $client->sendMessage($phone, $originator, $text);
    }
}
