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

use Intis\SDK\Exception\HLRResponseException;
use Intis\SDK\IntisClient;
use PHPUnit\Framework\TestCase;

class HLRResponseTest extends TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    /**
     * @covers \Intis\SDK\IntisClient::makeHLRRequest
     */
    public function test_makeHLRRequest(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = array('442073238000', '442073238001');

        $result = $client->makeHLRRequest($phone);

        foreach ($result as $hlr) {
            $hlr->getId();
            $hlr->getDestination();
            $hlr->getIMSI();
            $hlr->getMCC();
            $hlr->getMNC();
            $hlr->getOriginalCountryCode();
            $hlr->getOriginalCountryName();
            $hlr->getOriginalNetworkName();
            $hlr->getOriginalNetworkPrefix();
            $hlr->getPortedCountryName();
            $hlr->getPortedCountryPrefix();
            $hlr->getPortedNetworkName();
            $hlr->getPortedNetworkPrefix();
            $hlr->getRoamingCountryName();
            $hlr->getRoamingCountryPrefix();
            $hlr->getRoamingNetworkName();
            $hlr->getRoamingNetworkPrefix();
            $hlr->getStatus();
            $hlr->getPricePerMessage();
            $hlr->isInRoaming();
            $hlr->isPorted();
        }

        $this->assertIsArray($result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\HLRResponse',$first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::makeHLRRequest
     */
    public function test_makeHLRRequestException(){
        $this->expectException(HLRResponseException::class);
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = array('442073238000', '442073238001');

        $result = $client->makeHLRRequest($phone);
    }

    private function getData(){
        $result = '[{"id":"4133004490987800000001","destination":"442073238000","message_id":"x6ikubibd4y5ljdnttxt","IMSI":"250017224827276","stat":"DELIVRD","error":"0","orn":"Landline","pon":"Landline","ron":"Landline","mccmnc":"25001","rcn":"United Kingdom","ppm":"932","onp":"91788","ocn":"United Kingdom","ocp":"7","is_ported":"false","rnp":"917","rcp":"7","is_roaming":"false","pnp":"442073238000","pcn":"United Kingdom","pcp":"7","total_price":"0.2","request_id":"607a199fb7dc99e68af1196f659c23cf","request_time":"2014-10-14 19:27:29"},'.
            '{"id":"4115440762085900000001","destination":"442073238001","message_id":"l9likizqtxau2e5gbbho","IMSI":"250017145699048","stat":"DELIVRD","error":"0","orn":"Landline","pon":"Landline","ron":"Landline","mccmnc":"25001","rcn":"United Kingdom","ppm":"932","onp":"93718","ocn":"United Kingdom","ocp":"7","is_ported":"true","rnp":"91701","rcp":"7","is_roaming":"false","pnp":"442073238001","pcn":"United Kingdom","pcp":"7","total_price":"0.2","request_id":"79cdde57cea85f1cc2728f7c0d48f0bd","request_time":"2014-09-24 11:34:36"}]';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
