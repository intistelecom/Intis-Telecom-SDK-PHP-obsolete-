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

use Intis\SDK\Exception\DailyStatsException;
use Intis\SDK\IntisClient;
use PHPUnit\Framework\TestCase;

class DailyStatsByMonthTest extends TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    /**
     * @covers \Intis\SDK\IntisClient::getDailyStatsByMonth
     */
    public function test_getDailyStatsByMonth(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $year = 2014;
        $month = 10;

        $result = $client->getDailyStatsByMonth($year, $month);

        foreach($result as $one){
            $one->getDay();
            $stats = $one->getStats();
            foreach($stats as $i){
                $i->getState();
                $i->getCost();
                $i->getCount();
            }
        }

        $this->assertIsArray($result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\DailyStats',$first);
    }

    /**
     * @covers \Intis\SDK\IntisClient::getDailyStatsByMonth
     */
    public function test_getDailyStatsByMonthException(){
        $this->expectException(DailyStatsException::class);
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $year = 2014;
        $month = 10;

        $client->getDailyStatsByMonth($year, $month);
    }

    private function getData(){
        $result =
            '[{"date":"2014-10-02","stats":[{"status":"deliver","cost":"1.000","parts":"2"},{"status":"not_deliver","cost":"0.500","parts":"1"}]},'.
            '{"date":"2014-10-13","stats":[{"status":"deliver","cost":"161.850","parts":"358"},{"status":"expired","cost":"1.650","parts":"4"},{"status":"not_deliver","cost":"87.700","parts":"198"}]},'.
            '{"date":"2014-10-31","stats":[{"status":"not_deliver","cost":"211.200","parts":"459"},{"status":"deliver","cost":"327.950","parts":"712"}]}]';

        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
