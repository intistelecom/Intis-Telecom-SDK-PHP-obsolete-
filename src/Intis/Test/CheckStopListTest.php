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


class CheckStopListTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_checkStopList(){
        $connector = new LocalApiConnector($this->getData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $phone = '79009009090';

        $stopList = $client->checkStopList($phone);
        $stopList->getId();
        $stopList->getDescription();
        $stopList->getTimeAddedAt();

        $this->assertInstanceOf('Intis\SDK\Entity\StopList',$stopList);
    }

    /**
     * @expectedException Intis\SDK\Exception\StopListException
     */
    public function test_checkStopListException(){
        $connector = new LocalApiConnector($this->getErrorData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = '79009009090';
        $client->checkStopList($phone);
    }

    private function getData(){
        $result = '{"4494794":{"time_in":"2015-07-31 22:55:00","description":"test"}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
