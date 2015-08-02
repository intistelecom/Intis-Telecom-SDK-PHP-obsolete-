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


class BalanceTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getBalance(){
        $connector = new LocalApiConnector($this->getData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $balance = $client->getBalance();

        $amount = $balance->getAmount();
        $currency = $balance->getCurrency();

        $this->assertInstanceOf('Intis\SDK\Entity\Balance',$balance);
    }

    /**
     * @expectedException Intis\SDK\Exception\BalanceException
     */
    public function test_getBalanceException(){
        $connector = new LocalApiConnector($this->getErrorData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $client->getBalance();
    }

    private function getData(){
        $result = '{"money":4, "currency":"RUB"}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
