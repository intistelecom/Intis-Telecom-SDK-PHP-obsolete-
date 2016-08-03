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

class AddTemplateTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';


    public function test_addTemplate(){
        $connector = new LocalApiConnector($this->getData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $templteId = $client->addTemplate("testPHP3", "template for testPHP1");
        $this->assertNotEquals(0, $templteId);
    }

    public function test_editTemplate(){
        $connector = new LocalApiConnector($this->getData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $templteId = $client->editTemplate("testPHP3", "template for testPHP1");
        $this->assertNotEquals(0, $templteId);
    }

    /**
     * @expectedException Intis\SDK\Exception\AddTemplateException
     */
    public function test_addTemplateException(){
        $connector = new LocalApiConnector($this->getErrorData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $client->addTemplate("testPHP1", "template for testPHP1");
    }

    private function getData(){
        $result = '{"id":1}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
