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


class NetworkTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getNetworkByPhone(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phone = '79808008080';
        $network = $client->getNetworkByPhone($phone);

        $network->getTitle();

        $this->assertInstanceOf('Intis\SDK\Entity\Network',$network);
    }

    /**
     * @expectedException Intis\SDK\Exception\NetworkException
     */
    public function test_getNetworkByPhoneException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $phone = '79808008080';
        $client->getNetworkByPhone($phone);
    }
}
