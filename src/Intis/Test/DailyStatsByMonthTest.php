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

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getDailyStatsByMonth(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
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
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $year = 2014;
        $month = 10;

        $client->getDailyStatsByMonth($year, $month);
    }
}
