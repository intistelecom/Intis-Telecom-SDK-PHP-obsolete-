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

use Intis\SDK\Exception\IncomingMessageException;
use Intis\SDK\IntisClient;
use PHPUnit\Framework\TestCase;

class IncomingMessagesTest extends TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    /**
     * @covers \Intis\SDK\IntisClient::getIncomingMessages
     */
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

        $this->assertIsArray($result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\IncomingMessage',$first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::getIncomingMessages
     */
    public function test_getIncomingMessagesForPeriod(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $from = '2015-04-01 00:00:00';
        $to = '2015-04-01 23:00:00';
        $result = $client->getIncomingMessages($from, $to);

        foreach($result as $one){
            $one->getMessageId();
            $one->getOriginator();
            $one->getPrefix();
            $one->getReceivedAt();
            $one->getText();
        }

        $this->assertIsArray($result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\IncomingMessage',$first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::getIncomingMessages
     */
    public function test_getIncomingMessagesException(){
        $this->expectException(IncomingMessageException::class);
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $date = '2014-11-25';
        $client->getIncomingMessages($date);
    }

    private function getData(){
        $result = '{"75396":{"date":"2015-04-01 14:01:24","sender":"442073238000","prefix":"","text":"test1"},"75397":{"date":"2015-04-01 22:31:22","sender":"442073238001","prefix":"","text":"test 2"},"75398":{"date":"2015-04-01 22:37:13","sender":"442073238002","prefix":"","text":"test 3"},"75399":{"date":"2015-04-01 22:39:33","sender":"442073238003","prefix":"","text":"test 4"}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
