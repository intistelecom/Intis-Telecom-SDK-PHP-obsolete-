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


class IncomingMessagesTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getIncomingMessages(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $date = '2015-04-01';
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
    public function test_getIncomingMessagesException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $date = '2014-11-25';
        $client->getIncomingMessages($date);
    }

    private function getData(){
        $result = '{"75396":{"date":"2015-04-01 14:01:24","sender":"79099004898","prefix":"","text":"TEST"},"75397":{"date":"2015-04-01 22:31:22","sender":"79033145252","prefix":"","text":"111111111"},"75398":{"date":"2015-04-01 22:37:13","sender":"79099004898","prefix":"","text":"TEST INCOMING"},"75399":{"date":"2015-04-01 22:39:33","sender":"79033145252","prefix":"","text":"2222223"}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
