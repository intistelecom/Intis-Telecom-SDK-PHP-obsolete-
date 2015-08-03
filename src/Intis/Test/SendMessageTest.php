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
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_sendMessage(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = array('79802503672','79009009091');
        /*
         * || $phone = '79009009090,79009009091,79009009092'
         */
        $originator = "smstest";
        $text = "test message";
        $messages = $client->sendMessage($phone, $originator, $text);

        foreach($messages as $one){
            if($one->isOk()) {
                $one->getPhone();
                $one->getMessageId();
                $one->getCost();
                $one->getMessagesCount();
            }
            else{
                $one->getMessage();
                $one->getCode();
            }

        }

        $this->assertInternalType('array',$messages);
        $first = $messages[0];
        $this->assertInstanceOf('Intis\SDK\Entity\MessageSendingResult',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\MessageSendingResultException
     */
    public function test_sendMessageException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = array('79009009090','79009009091');
        /*
         * || $phone = '79009009090,79009009091,79009009092'
         */
        $originator = 'test';
        $text = 'test message';
        $client->sendMessage($phone, $originator, $text);
    }

    private function getData(){
        $result = '{"79009009090":{"error":"0","id_sms":"4384607771347164730001","cost":1,"count_sms":1,"sender":"smstest","network":" Russia MTC","ported":0},"79009009091":{"error":31}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
