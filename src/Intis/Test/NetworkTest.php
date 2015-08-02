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
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getNetworkByPhone(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = '79808008080';
        $network = $client->getNetworkByPhone($phone);

        $network->getTitle();

        $this->assertInstanceOf('Intis\SDK\Entity\Network',$network);
    }

    /**
     * @expectedException Intis\SDK\Exception\NetworkException
     */
    public function test_getNetworkByPhoneException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = '79808008080';
        $client->getNetworkByPhone($phone);
    }

    private function getData(){
        $result = '{"operator" : "AT&T"}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
