<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Intis Telecom
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
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
        $phone = array('442073238000','442073238001');

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
        $phone = array('442073238000','442073238001');

        $originator = 'test';
        $text = 'test message';
        $client->sendMessage($phone, $originator, $text);
    }

    private function getData(){
        $result = '{"442073238000":{"error":"0","id_sms":"4384607771347164730001","cost":1,"count_sms":1,"sender":"smstest","network":"United Kingdom","ported":0},"442073238001":{"error":31}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
