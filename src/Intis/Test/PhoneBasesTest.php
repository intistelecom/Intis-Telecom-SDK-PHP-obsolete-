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

use Intis\SDK\Exception\PhoneBaseException;
use Intis\SDK\IntisClient;
use PHPUnit\Framework\TestCase;

class PhoneBasesTest extends TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    /**
     * @covers \Intis\SDK\IntisClient::getPhoneBases
     */
    public function test_getPhoneBases(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phoneBases = $client->getPhoneBases();
        foreach($phoneBases as $oneBase){
            $oneBase->getBaseId();
            $oneBase->getTitle();
            $oneBase->getCount();
            $oneBase->getPages();

            $birthday = $oneBase->getBirthdayGreetingSettings();
            $birthday->getEnabled();
            $birthday->getDaysBefore();
            $birthday->getOriginator();
            $birthday->getTimeToSend();
            $birthday->getUseLocalTime();
            $birthday->getTemplate();
        }

        $this->assertIsArray($phoneBases);
        $first = $phoneBases[0];
        $this->assertInstanceOf('Intis\SDK\Entity\PhoneBase',$first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::getPhoneBases
     */
    public function test_getPhoneBasesException(){
        $this->expectException(PhoneBaseException::class);
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $client->getPhoneBases();
    }

    private function getData(){
        $result = '{"125480":{"name":"989878979","time_birth":"12:00:00","day_before":"0","local_time":"1","birth_sender":"","birth_text":"","on_birth":"0","count":"0","pages":0},'.
            '"125473":{"name":"654564","time_birth":"12:00:00","day_before":"0","local_time":"1","birth_sender":"","birth_text":"","on_birth":"0","count":"367","pages":4}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
