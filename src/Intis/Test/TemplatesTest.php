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

use Intis\SDK\Exception\TemplateException;
use Intis\SDK\IntisClient;
use PHPUnit\Framework\TestCase;

class TemplatesTest extends TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    /**
     * @covers \Intis\SDK\IntisClient::getTemplates
     */
    public function test_getTemplates(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $templates = $client->getTemplates();

        foreach ($templates as $template) {
            $template->getId();
            $template->getTitle();
            $template->getTemplate();
            $template->getCreatedAt();
        }

        $this->assertIsArray( $templates);
        $first = $templates[0];
        $this->assertInstanceOf('Intis\SDK\Entity\Template', $first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::getTemplates
     */
    public function test_getTemplatesException(){
        $this->expectException(TemplateException::class);
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $client->getTemplates();
    }

    private function getData()
    {
        $result = '{"25583":{"name":"newtemplate","template":"Hello! #first-name# #last-name#! Your amount is #note1#","up_time":"2015-03-31 15:22:50"},"25586":{"name":"test1","template":"template for test1","up_time":"2015-07-29 15:37:47"},"25582":{"name":"vnb cv","template":"test","up_time":"2015-03-30 17:34:39"}}';
        return json_decode($result);
    }

    private function getErrorData()
    {
        $result = '{"error":4}';
        return json_decode($result);
    }
}
