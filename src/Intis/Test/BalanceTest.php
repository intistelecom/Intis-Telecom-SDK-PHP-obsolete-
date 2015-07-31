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

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getBalance(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $balance = $client->getBalance();

        $amount = $balance->getAmount();
        $currency = $balance->getCurrency();

        $this->assertInstanceOf('Intis\SDK\Entity\Balance',$balance);
    }

    /**
     * @expectedException Intis\SDK\SDKException
     */
    public function test_getBalanceException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $client->getBalance();
    }
}
