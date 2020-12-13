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

use Intis\SDK\Exception\PhoneBaseItemException;
use Intis\SDK\IntisClient;
use PHPUnit\Framework\TestCase;

class PhoneBaseItemsTest extends TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    /**
     * @covers \Intis\SDK\IntisClient::getPhoneBaseItems
     */
    public function test_getPhoneBaseItems(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $baseId = 125508;
        $page = 1;
        $items = $client->getPhoneBaseItems($baseId, $page);

        foreach($items as $item){
            $item->getPhone();
            $item->getFirstName();
            $item->getMiddleName();
            $item->getLastName();
            $item->getGender();
            $item->getNetwork();
            $item->getArea();
            $item->getNote1();
            $item->getNote2();
        }

        $this->assertIsArray($items);
        $first = $items[0];
        $this->assertInstanceOf('Intis\SDK\Entity\PhoneBaseItem',$first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::getPhoneBaseItems
     */
    public function test_getPhoneBaseItemsException(){
        $this->expectException(PhoneBaseItemException::class);
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $baseId = 12547233333;
        $page = 1;
        $client->getPhoneBaseItems($baseId, $page);
    }

    private function getData(){
        $result = '{"442073238000":{"name":"Jon","last_name":"Voight","middle_name":"","date_birth":"0000-00-00","male":"m","note1":"","note2":"","region":null,"operator":null},'.
            '"442073238001":{"name":"Jon","last_name":"Voight","middle_name":"","date_birth":"0000-00-00","male":"m","note1":"","note2":"","region":null,"operator":null}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
