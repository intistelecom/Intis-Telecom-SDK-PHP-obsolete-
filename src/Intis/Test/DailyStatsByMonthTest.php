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


class DailyStatsByMonthTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

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

        $this->assertInternalType('array',$result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\DailyStats',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\DailyStatsException
     */
    public function test_getDailyStatsByMonthException(){
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
